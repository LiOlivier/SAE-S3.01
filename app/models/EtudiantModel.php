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
        $query = 'SELECT Utilisateur.nom, Utilisateur.prenom, Utilisateur.email, Utilisateur.telephone, Etudiant.id_Etudiant 
                  FROM Etudiant 
                  JOIN Utilisateur ON Etudiant.id_Etudiant = Utilisateur.id';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>