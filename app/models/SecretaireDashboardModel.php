<?php

class DashboardModel {
    private $db;

    public function __construct() {
        try {
            require_once(__DIR__ . "/../../config/database.php"); // Inclure database.php
            $this->db = Database::getConnexion(); // Utiliser la connexion centralisée
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getOverdueReportsCount() {
        $query = 'SELECT COUNT(*) AS overdue_reports FROM action WHERE date_realisation < NOW() AND id_type_action = 1';
        $stmt = $this->db->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['overdue_reports'];
    }

    public function getUpcomingSoutenancesCount() {
        $query = 'SELECT COUNT(*) AS upcoming_soutenances FROM stage 
                  WHERE date_soutenance BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY)
                  AND salle_soutenance IS NOT NULL
                  AND id_enseignant_2 IS NOT NULL';
        $stmt = $this->db->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['upcoming_soutenances'];
    }

    public function getStagesWithoutJuryCount() {
        $query = 'SELECT COUNT(*) AS stages_without_jury FROM stage 
                  WHERE id_enseignant_2 IS NULL';
        $stmt = $this->db->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['stages_without_jury'];
    }

    public function getTotalStudentsCount() {
        $query = 'SELECT COUNT(*) AS total_students FROM etudiant';
        $stmt = $this->db->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_students'];
    }

    public function getTotalStagesCount() {
        $query = 'SELECT COUNT(*) AS total_stages FROM stage';
        $stmt = $this->db->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_stages'];
    }

    public function getRecentNotifications() {
        $query = 'SELECT utilisateur.nom, utilisateur.prenom, action.date_realisation, typeaction.libelle 
                  FROM action 
                  JOIN utilisateur ON action.id = utilisateur.id 
                  JOIN typeaction ON action.id_type_action = typeaction.id_type_action 
                  ORDER BY action.date_realisation DESC 
                  LIMIT 10';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>