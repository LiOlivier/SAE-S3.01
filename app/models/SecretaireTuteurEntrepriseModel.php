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
        $query = 'SELECT u.nom, u.prenom, u.email, u.telephone, te.Id_Tuteur_Entreprise as id_tuteur_entreprise, e.adresse, e.code_postal, e.ville, e.tel as entreprise_tel 
                  FROM Tuteur_Entreprise te 
                  JOIN Utilisateur u ON te.Id_Tuteur_Entreprise = u.id 
                  JOIN entreprise e ON te.id_entreprise = e.id_entreprise';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>