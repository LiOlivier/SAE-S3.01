<?php

class EtudiantModel {
    private $db;

    public function __construct() {
        try {
            require_once(__DIR__ . "/../../config/database.php"); // Inclure database.php
            $this->db = Database::getConnexion(); // Utiliser la connexion centralisée
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getAllEtudiants() {
        $query = 'SELECT utilisateur.nom, utilisateur.prenom, utilisateur.email, utilisateur.telephone, etudiant.id_etudiant 
                  FROM etudiant 
                  JOIN utilisateur ON etudiant.id_etudiant = utilisateur.id';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>