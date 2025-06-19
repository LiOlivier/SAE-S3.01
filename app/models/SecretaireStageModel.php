<?php

class StageModel {
    private $db;

    public function __construct() {
        try {
            require_once(__DIR__ . "/../../config/database.php");
            $this->db = Database::getConnexion();
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getAllStages($department = null, $year = null, $search = null, $sort = 'id_etudiant', $order = 'ASC', $offset = 0, $rowsPerPage = 10) {
        $query = "
            SELECT 
                s.annee, 
                s.id_departement, 
                d.libelle AS departement_name, 
                s.num_semestre, 
                s.id_etudiant, 
                CONCAT(u1.nom, ' ', u1.prenom) AS student_name, 
                s.id_stage, 
                s.date_debut, 
                s.date_fin, 
                s.mission, 
                s.date_soutenance, 
                s.salle_soutenance, 
                s.id_enseignant_1, 
                CONCAT(u2.nom, ' ', u2.prenom) AS academic_tutor_name, 
                s.id_tuteur_entreprise, 
                CONCAT(u3.nom, ' ', u3.prenom) AS company_tutor_name, 
                s.id_enseignant_2, 
                CONCAT(u4.nom, ' ', u4.prenom) AS second_jury_name,
                e.ville AS company_name,
                (SELECT COUNT(*) 
                 FROM action a 
                 JOIN typeaction ta ON a.id_type_action = ta.id_type_action 
                 WHERE a.id_stage = s.id_stage 
                 AND a.etat = 'A faire' 
                 AND (ta.delai_en_jours IS NOT NULL 
                     AND DATE_ADD(s.date_debut, INTERVAL ta.delai_en_jours DAY) < CURDATE()
                     OR ta.delai_limite IS NOT NULL AND ta.delai_limite < CURDATE())
                ) AS overdue_actions
            FROM stage s
            LEFT JOIN departement d ON s.id_departement = d.id_departement
            LEFT JOIN utilisateur u1 ON s.id_etudiant = u1.id AND u1.role = 'etudiant'
            LEFT JOIN utilisateur u2 ON s.id_enseignant_1 = u2.id AND u2.role IN ('enseignant', 'pedagogique')
            LEFT JOIN utilisateur u3 ON s.id_tuteur_entreprise = u3.id AND u3.role = 'tuteur'
            LEFT JOIN utilisateur u4 ON s.id_enseignant_2 = u4.id AND u4.role IN ('enseignant', 'pedagogique')
            LEFT JOIN tuteur_entreprise te ON s.id_tuteur_entreprise = te.id_tuteur_entreprise
            LEFT JOIN entreprise e ON te.id_entreprise = e.id_entreprise
            WHERE 1=1
        ";

        $params = [];
        if ($department) {
            $query .= " AND s.id_departement = :department";
            $params[':department'] = $department;
        }
        if ($year) {
            $query .= " AND s.annee = :year";
            $params[':year'] = $year;
        }
        if ($search) {
            $query .= " AND (u1.nom LIKE :search OR u1.prenom LIKE :search OR e.ville LIKE :search)";
            $params[':search'] = "%$search%";
        }

        $allowed_sort_columns = ['student_name', 'company_name', 'date_debut', 'date_fin', 'overdue_actions'];
        $sort = in_array($sort, $allowed_sort_columns) ? $sort : 'id_etudiant';
        $order = strtoupper($order) === 'DESC' ? 'DESC' : 'ASC';
        if ($sort === 'student_name') {
            $query .= " ORDER BY u1.nom $order, u1.prenom $order";
        } elseif ($sort === 'company_name') {
            $query .= " ORDER BY e.ville $order";
        } else {
            $query .= " ORDER BY $sort $order";
        }

        $query .= " LIMIT :offset, :rowsPerPage";

        $stmt = $this->db->prepare($query);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':rowsPerPage', (int)$rowsPerPage, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalRows($department = null, $year = null, $search = null) {
        $query = "
            SELECT COUNT(*) 
            FROM stage s
            LEFT JOIN utilisateur u1 ON s.id_etudiant = u1.id AND u1.role = 'etudiant'
            LEFT JOIN tuteur_entreprise te ON s.id_tuteur_entreprise = te.id_tuteur_entreprise
            LEFT JOIN entreprise e ON te.id_entreprise = e.id_entreprise
            WHERE 1=1
        ";

        $params = [];
        if ($department) {
            $query .= " AND s.id_departement = :department";
            $params[':department'] = $department;
        }
        if ($year) {
            $query .= " AND s.annee = :year";
            $params[':year'] = $year;
        }
        if ($search) {
            $query .= " AND (u1.nom LIKE :search OR u1.prenom LIKE :search OR e.ville LIKE :search)";
            $params[':search'] = "%$search%";
        }

        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return (int)$stmt->fetchColumn();
    }

    public function getDepartments() {
        $query = "SELECT id_departement AS id_department, libelle FROM departement";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getYears() {
        $query = "SELECT annee FROM annee";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>