<?php

class DashboardModel {
    private $db;

<<<<<<< HEAD
    public function __construct() {
        try {
            require_once(__DIR__ . "/../../config/database.php"); // Inclure database.php
            $this->db = Database::getConnexion(); // Utiliser la connexion centralisée
=======
    public function __construct($dsn, $login, $mdp) {
        try {
            $this->db = new PDO($dsn, $login, $mdp);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->exec("USE sorbonne");
>>>>>>> 145365576bb88050561c7ed14ad2574d84df58c3
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getOverdueReportsCount() {
<<<<<<< HEAD
        $query = 'SELECT COUNT(*) AS overdue_reports FROM Action WHERE date_realisation < NOW() AND id_type_action = 1';
=======
        $query = 'SELECT COUNT(*) AS overdue_reports FROM Action WHERE date_realisation < NOW() AND Id_TypeAction = 1';
>>>>>>> 145365576bb88050561c7ed14ad2574d84df58c3
        $stmt = $this->db->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['overdue_reports'];
    }

    public function getUpcomingSoutenancesCount() {
        $query = 'SELECT COUNT(*) AS upcoming_soutenances FROM Stage 
                  WHERE date_soutenance BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY)
                  AND salle_soutenance IS NOT NULL
                  AND Id_Enseignant_2 IS NOT NULL';
        $stmt = $this->db->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['upcoming_soutenances'];
    }

    public function getStagesWithoutJuryCount() {
        $query = 'SELECT COUNT(*) AS stages_without_jury FROM Stage 
                  WHERE Id_Enseignant_2 IS NULL';
        $stmt = $this->db->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['stages_without_jury'];
    }

    public function getTotalStudentsCount() {
        $query = 'SELECT COUNT(*) AS total_students FROM Etudiant';
        $stmt = $this->db->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_students'];
    }

    public function getTotalStagesCount() {
        $query = 'SELECT COUNT(*) AS total_stages FROM Stage';
        $stmt = $this->db->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_stages'];
    }

    public function getRecentNotifications() {
        $query = 'SELECT Utilisateur.nom, Utilisateur.prenom, Action.date_realisation, TypeAction.libelle 
                  FROM Action 
                  JOIN Utilisateur ON Action.Id = Utilisateur.Id 
<<<<<<< HEAD
                  JOIN TypeAction ON Action.Id_Type_Action = TypeAction.Id_Type_Action 
=======
                  JOIN TypeAction ON Action.Id_TypeAction = TypeAction.Id_TypeAction 
>>>>>>> 145365576bb88050561c7ed14ad2574d84df58c3
                  ORDER BY Action.date_realisation DESC 
                  LIMIT 10';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>