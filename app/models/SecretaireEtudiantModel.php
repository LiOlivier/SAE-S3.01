<?php

class EtudiantModel {
    private $db;

    public function __construct() {
        try {
            require_once(__DIR__ . "/../../config/database.php");
            $this->db = Database::getConnexion();
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    private function validateColumn($column) {
        $allowedColumns = ['nom', 'prenom', 'email', 'telephone'];
        return in_array($column, $allowedColumns) ? $column : 'nom';
    }

    public function getAllEtudiants($search = '', $sortColumn = 'nom', $sortOrder = 'ASC', $department = '', $semester = '', $year = '', $limit = 10, $offset = 0) {
        $sortColumn = $this->validateColumn($sortColumn);
        $query = 'SELECT utilisateur.nom, utilisateur.prenom, utilisateur.email, utilisateur.telephone, etudiant.id_etudiant 
                  FROM etudiant 
                  JOIN utilisateur ON etudiant.id_etudiant = utilisateur.id
                  JOIN inscription ON etudiant.id_etudiant = inscription.id_etudiant';
        
        $conditions = [];
        $params = [];

        if (!empty($search)) {
            $conditions[] = '(utilisateur.nom LIKE :search OR utilisateur.prenom LIKE :search OR utilisateur.email LIKE :search OR utilisateur.telephone LIKE :search)';
            $params[':search'] = '%' . $search . '%';
        }

        if (!empty($department)) {
            $conditions[] = 'inscription.id_departement = :department';
            $params[':department'] = $department;
        }

        if (!empty($semester)) {
            $conditions[] = 'inscription.num_semestre = :semester';
            $params[':semester'] = $semester;
        }

        if (!empty($year)) {
            $conditions[] = 'inscription.annee = :year';
            $params[':year'] = $year;
        }

        if (!empty($conditions)) {
            $query .= ' WHERE ' . implode(' AND ', $conditions);
        }

        $query .= ' ORDER BY utilisateur.`' . $sortColumn . '` ' . ($sortOrder === 'ASC' ? 'ASC' : 'DESC');
        $query .= ' LIMIT :limit OFFSET :offset';

        $stmt = $this->db->prepare($query);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalEtudiants($search = '', $department = '', $semester = '', $year = '') {
        $query = 'SELECT COUNT(*) 
                  FROM etudiant 
                  JOIN utilisateur ON etudiant.id_etudiant = utilisateur.id
                  JOIN inscription ON etudiant.id_etudiant = inscription.id_etudiant';
        
        $conditions = [];
        $params = [];

        if (!empty($search)) {
            $conditions[] = '(utilisateur.nom LIKE :search OR utilisateur.prenom LIKE :search OR utilisateur.email LIKE :search OR utilisateur.telephone LIKE :search)';
            $params[':search'] = '%' . $search . '%';
        }

        if (!empty($department)) {
            $conditions[] = 'inscription.id_departement = :department';
            $params[':department'] = $department;
        }

        if (!empty($semester)) {
            $conditions[] = 'inscription.num_semestre = :semester';
            $params[':semester'] = $semester;
        }

        if (!empty($year)) {
            $conditions[] = 'inscription.annee = :year';
            $params[':year'] = $year;
        }

        if (!empty($conditions)) {
            $query .= ' WHERE ' . implode(' AND ', $conditions);
        }

        $stmt = $this->db->prepare($query);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getDepartments() {
        $query = 'SELECT id_departement, libelle FROM departement';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSemesters() {
        $query = 'SELECT DISTINCT num_semestre FROM semestre';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getYears() {
        $query = 'SELECT annee FROM annee';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
?>