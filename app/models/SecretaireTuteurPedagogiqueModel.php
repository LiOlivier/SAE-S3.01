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

    public function getAllTuteursPedagogiques($offset = 0, $rowsPerPage = 10) {
        $query = 'SELECT nom, prenom, email, telephone 
                  FROM Utilisateur 
                  WHERE FIND_IN_SET("pedagogique", role) 
                  LIMIT :offset, :rowsPerPage';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':rowsPerPage', (int)$rowsPerPage, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalTuteursPedagogiques() {
        $query = 'SELECT COUNT(*) 
                  FROM Utilisateur 
                  WHERE FIND_IN_SET("pedagogique", role)';
        $stmt = $this->db->query($query);
        return (int)$stmt->fetchColumn();
    }
}
?>