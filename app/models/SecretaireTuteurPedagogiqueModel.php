<?php

class TuteurPedagogiqueModel {
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
        $query = 'SELECT nom, prenom, email, telephone 
                  FROM Utilisateur 
                  WHERE FIND_IN_SET("pedagogique", role)';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>