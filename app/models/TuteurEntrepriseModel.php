<?php

class TuteurEntrepriseModel {
    private $db;

    public function __construct() {
        try {
            require_once(__DIR__ . "/../../config/database.php"); // Inclure database.php
            $this->db = Database::getConnexion(); // Utiliser la connexion centralisée
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getAllTuteursEntreprise() {
        $query = 'SELECT Utilisateur.nom, Utilisateur.prenom, Utilisateur.email, Utilisateur.telephone, Tuteur_Entreprise.Id_Entreprise 
                  FROM Tuteur_Entreprise 
                  JOIN Utilisateur ON Tuteur_Entreprise.Id_Tuteur_Entreprise = Utilisateur.id';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>