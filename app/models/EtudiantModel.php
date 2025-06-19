<?php

class EtudiantModel {
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

    public function getAllEtudiants() {
        $query = 'SELECT Utilisateur.nom, Utilisateur.prenom, Utilisateur.email, Utilisateur.telephone, Etudiant.id_Etudiant 
                  FROM Etudiant 
                  JOIN Utilisateur ON Etudiant.id_Etudiant = Utilisateur.id';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>