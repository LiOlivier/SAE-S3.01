<?php

class StagePlanningModel {
    private $db;

    public function __construct() {
        try {
            require_once(__DIR__ . "/../../config/database.php"); // Inclure database.php
            $this->db = Database::getConnexion(); // Utiliser la connexion centralisée
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getAllTuteursPedagogiques() {
        $query = 'SELECT Id_Enseignant, nom, prenom FROM Enseignant JOIN Utilisateur ON Enseignant.Id_Enseignant = Utilisateur.id WHERE role = "pedagogique"';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllTuteursEntreprises() {
        $query = 'SELECT Id_Tuteur_Entreprise, nom, prenom FROM Tuteur_Entreprise JOIN Utilisateur ON Tuteur_Entreprise.Id_Tuteur_Entreprise = Utilisateur.id';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllEtudiants() {
        $query = 'SELECT Id_Etudiant, nom, prenom FROM Etudiant JOIN Utilisateur ON Etudiant.Id_Etudiant = Utilisateur.id';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllEnseignants() {
        $query = 'SELECT Id_Enseignant, nom, prenom FROM Enseignant JOIN Utilisateur ON Enseignant.Id_Enseignant = Utilisateur.id';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllDepartements() {
        $query = 'SELECT Id_Departement, Libelle FROM Departement';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllAnnees() {
        $query = 'SELECT annee FROM annee';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllStageStudents() {
        $query = 'SELECT DISTINCT Etudiant.Id_Etudiant, Utilisateur.nom, Utilisateur.prenom FROM Stage JOIN Etudiant ON Stage.Id_Etudiant = Etudiant.Id_Etudiant JOIN Utilisateur ON Etudiant.Id_Etudiant = Utilisateur.id';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllEntreprises() {
        $query = 'SELECT Id_Entreprise AS nom FROM Entreprise';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addStage($studentId, $semester, $Id_Departement, $startDate, $endDate, $mission, $Id_Entreprise) {
        // Check if the student already has 2 stages
        $query = 'SELECT COUNT(*) AS stage_count FROM Stage WHERE Id_Etudiant = :studentId';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['stage_count'] >= 2) {
            return false;
        }

        // Check if the student already has a stage in the selected semester
        $query = 'SELECT COUNT(*) AS semester_stage_count FROM Stage WHERE Id_Etudiant = :studentId AND num_Semestre = :semester';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
        $stmt->bindParam(':semester', $semester, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['semester_stage_count'] > 0) {
            return false;
        }

        // Retrieve the annee from the inscription table
        $query = 'SELECT annee FROM inscription WHERE Id_Etudiant = :studentId AND num_Semestre = :semester AND Id_Departement = :Id_Departement';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
        $stmt->bindParam(':semester', $semester, PDO::PARAM_INT);
        $stmt->bindParam(':Id_Departement', $Id_Departement, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return false;
        }

        $annee = $result['annee'];

        // Insert the new stage with enterprise
        $query = 'INSERT INTO Stage (Id_Etudiant, num_Semestre, annee, Id_Departement, date_debut, date_fin, mission, Id_Entreprise) VALUES (:studentId, :semester, :annee, :Id_Departement, :startDate, :endDate, :mission, :Id_Entreprise)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
        $stmt->bindParam(':semester', $semester, PDO::PARAM_INT);
        $stmt->bindParam(':annee', $annee, PDO::PARAM_INT);
        $stmt->bindParam(':Id_Departement', $Id_Departement, PDO::PARAM_INT);
        $stmt->bindParam(':startDate', $startDate, PDO::PARAM_STR);
        $stmt->bindParam(':endDate', $endDate, PDO::PARAM_STR);
        $stmt->bindParam(':mission', $mission, PDO::PARAM_STR);
        $stmt->bindParam(':Id_Entreprise', $Id_Entreprise, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function assignTuteur($studentId, $semester, $tuteurPedagogiqueId, $tuteurEntrepriseId) {
        // Check if the stage exists
        $query = 'SELECT COUNT(*) AS stage_exists FROM Stage WHERE Id_Etudiant = :studentId AND num_Semestre = :semester';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
        $stmt->bindParam(':semester', $semester, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['stage_exists'] == 0) {
            return false;
        }

        $query = 'UPDATE Stage SET Id_Enseignant_1 = :tuteurPedagogiqueId, Id_Tuteur_Entreprise = :tuteurEntrepriseId WHERE Id_Etudiant = :studentId AND num_Semestre = :semester';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
        $stmt->bindParam(':semester', $semester, PDO::PARAM_INT);
        $stmt->bindParam(':tuteurPedagogiqueId', $tuteurPedagogiqueId, PDO::PARAM_INT);
        $stmt->bindParam(':tuteurEntrepriseId', $tuteurEntrepriseId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function assignJury($studentId, $semester, $juryId, $date, $salle_soutenance) {
        // Check if the stage exists
        $query = 'SELECT COUNT(*) AS stage_exists FROM Stage WHERE Id_Etudiant = :studentId AND num_Semestre = :semester';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
        $stmt->bindParam(':semester', $semester, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['stage_exists'] == 0) {
            return false;
        }

        $query = 'UPDATE Stage SET Id_Enseignant_2 = :juryId, date_soutenance = :date, salle_soutenance = :salle_soutenance WHERE Id_Etudiant = :studentId AND num_Semestre = :semester';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
        $stmt->bindParam(':semester', $semester, PDO::PARAM_INT);
        $stmt->bindParam(':juryId', $juryId, PDO::PARAM_INT);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':salle_soutenance', $salle_soutenance, PDO::PARAM_STR);
        return $stmt->execute();
    }
}
?>