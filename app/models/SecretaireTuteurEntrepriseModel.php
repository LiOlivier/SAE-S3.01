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

    public function getTuteursEntrepriseFiltered($search = '', $sort = 'nom', $order = 'asc', $offset = 0, $limit = 10) {
        $allowedSort = ['nom', 'prenom', 'email', 'telephone'];
        $sort = in_array($sort, $allowedSort) ? $sort : 'nom';
        $order = strtolower($order) === 'desc' ? 'DESC' : 'ASC';

        $params = [];
        $where = '';
        if (!empty($search)) {
            $where = "WHERE (u.nom LIKE :search OR u.prenom LIKE :search OR u.email LIKE :search OR u.telephone LIKE :search)";
            $params[':search'] = '%' . $search . '%';
        }

        $query = "SELECT u.nom, u.prenom, u.email, u.telephone, te.Id_Tuteur_Entreprise as id_tuteur_entreprise, e.adresse, e.code_postal, e.ville, e.tel as entreprise_tel
                  FROM Tuteur_Entreprise te
                  JOIN Utilisateur u ON te.Id_Tuteur_Entreprise = u.id
                  JOIN entreprise e ON te.id_entreprise = e.id_entreprise
                  $where
                  ORDER BY u.$sort $order
                  LIMIT :offset, :limit";
        $stmt = $this->db->prepare($query);
        foreach ($params as $k => $v) {
            $stmt->bindValue($k, $v, PDO::PARAM_STR);
        }
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countTuteursEntrepriseFiltered($search = '') {
        $params = [];
        $where = '';
        if (!empty($search)) {
            $where = "WHERE (u.nom LIKE :search OR u.prenom LIKE :search OR u.email LIKE :search OR u.telephone LIKE :search)";
            $params[':search'] = '%' . $search . '%';
        }
        $query = "SELECT COUNT(*) FROM Tuteur_Entreprise te
                  JOIN Utilisateur u ON te.Id_Tuteur_Entreprise = u.id
                  JOIN entreprise e ON te.id_entreprise = e.id_entreprise
                  $where";
        $stmt = $this->db->prepare($query);
        foreach ($params as $k => $v) {
            $stmt->bindValue($k, $v, PDO::PARAM_STR);
        }
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}
?>