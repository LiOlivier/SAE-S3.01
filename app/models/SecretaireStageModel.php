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
        $query = 'SELECT annee, id_departement, num_semestre, id_etudiant, id_stage, date_debut, date_fin, mission, date_soutenance, salle_soutenance, id_enseignant_1, id_tuteur_entreprise, id_enseignant_2 
                  FROM stage 
                  ORDER BY id_etudiant ASC';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>