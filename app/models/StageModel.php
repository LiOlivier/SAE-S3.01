<?php

class StageModel {
    private $db;

    public function __construct() {
        try {
            require_once(__DIR__ . "/../../config/database.php"); // Inclure database.php
            $this->db = Database::getConnexion(); // Utiliser la connexion centralisée
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getAllStages() {
        $query = 'SELECT annee, Id_Departement, numSemestre, Id_Etudiant, Id_Stage, date_debut, date_fin, mission, date_soutenance, salle_soutenance, Id_Enseignant_1, Id_Tuteur_Entreprise, Id_Enseignant_2 
                  FROM Stage 
                  ORDER BY Id_Etudiant ASC';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>