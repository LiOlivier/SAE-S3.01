<?php

class TuteurPedagogiqueModel {
    private $db;

    public function __construct() {
        try {
            require_once(__DIR__ . "/../../config/database.php");
            $this->db = Database::getConnexion();
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getTuteursPedagogiques($offset = 0, $rowsPerPage = 10, $search = '', $sort = 'nom', $order = 'ASC', $filter = 'all') {
        $query = 'SELECT nom, prenom, email, telephone, id 
                  FROM Utilisateur 
                  WHERE FIND_IN_SET("pedagogique", role)';
        $params = [];

        // Search
        if ($search) {
            $query .= ' AND (nom LIKE :search OR prenom LIKE :search OR email LIKE :search OR telephone LIKE :search)';
            $params[':search'] = "%$search%";
        }

        // Filter (active = no students, all = all pedagogiques)
        if ($filter === 'active') {
            $query .= ' AND id NOT IN (
                SELECT id_pedagogique FROM action WHERE id_pedagogique IS NOT NULL
                UNION
                SELECT id_enseignant_1 FROM stage WHERE id_enseignant_1 IS NOT NULL
                UNION
                SELECT id_enseignant_2 FROM stage WHERE id_enseignant_2 IS NOT NULL
            )';
        }

        // Sort
        $query .= " ORDER BY $sort $order";

        // Pagination
        $query .= ' LIMIT :offset, :rowsPerPage';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':rowsPerPage', (int)$rowsPerPage, PDO::PARAM_INT);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalTuteursPedagogiques($search = '', $filter = 'all') {
        $query = 'SELECT COUNT(*) 
                  FROM Utilisateur 
                  WHERE FIND_IN_SET("pedagogique", role)';
        $params = [];

        if ($search) {
            $query .= ' AND (nom LIKE :search OR prenom LIKE :search OR email LIKE :search OR telephone LIKE :search)';
            $params[':search'] = "%$search%";
        }

        if ($filter === 'active') {
            $query .= ' AND id NOT IN (
                SELECT id_pedagogique FROM action WHERE id_pedagogique IS NOT NULL
                UNION
                SELECT id_enseignant_1 FROM stage WHERE id_enseignant_1 IS NOT NULL
                UNION
                SELECT id_enseignant_2 FROM stage WHERE id_enseignant_2 IS NOT NULL
            )';
        }

        $stmt = $this->db->prepare($query);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, PDO::PARAM_STR);
        }
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    public function canRemoveTuteurPedagogique($id) {
        $query = 'SELECT COUNT(*) 
                  FROM (
                      SELECT id_pedagogique FROM action WHERE id_pedagogique = :id
                      UNION
                      SELECT id_enseignant_1 FROM stage WHERE id_enseignant_1 = :id
                      UNION
                      SELECT id_enseignant_2 FROM stage WHERE id_enseignant_2 = :id
                  ) AS counts';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn() == 0;
    }

    public function updateTuteurRole($id, $newRole) {
        $query = 'UPDATE Utilisateur 
                  SET role = :newRole 
                  WHERE id = :id AND FIND_IN_SET("pedagogique", role)';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->bindValue(':newRole', $newRole, PDO::PARAM_STR);
        return $stmt->execute();
    }
}
?>