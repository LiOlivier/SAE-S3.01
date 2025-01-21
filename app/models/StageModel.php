<?php

class StageModel {
    private $db;

    public function __construct($dsn, $login, $mdp) {
        try {
            $this->db = new PDO($dsn, $login, $mdp);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->exec("USE sorbonne");
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getAllStages() {
        $query = 'SELECT annee, Id_Departement, numSemestre, Id_Etudiant, Id_Stage, date_debut, date_fin, mission, date_soutenance, salle_soutenance, Id_Enseignant_1, Id_Tuteur_Entreprise, Id_Enseignant_2 
                  FROM Stage 
                  ORDER BY Id_Etudiant ASC';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>