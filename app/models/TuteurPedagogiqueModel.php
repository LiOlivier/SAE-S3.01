<?php

   class TuteurPedagogiqueModel {
    private $bd;

    public function __construct() {
        try {
            require_once(__DIR__ . "/../../config/database.php");
            $this->bd = Database::getConnexion(); // <- ici le bon nom est "bd"
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getListeEtudiants($idTuteur) {
        $sql = '
            SELECT 
                u.id, u.nom, u.prenom, u.email, u.telephone,
                d.Libelle,
                s.Id_Enseignant_1 as id_tuteur_pedagogique,
                s.Id_Stage as id_stage,
                CASE 
                    WHEN NOT EXISTS (
                        SELECT 1 
                        FROM action a 
                        WHERE a.Id_Etudiant = u.Id 
                        AND a.id_type_action = 7
                    ) THEN "En attente"
                    ELSE "Tâche complète"
                END AS BordereauEtat,
                CASE 
                    WHEN NOT EXISTS (
                        SELECT 1 
                        FROM action a 
                        WHERE a.Id_Etudiant = u.Id 
                        AND a.id_type_action = 9
                    ) THEN "En attente"
                    ELSE "Tâche complète"
                END AS ConventionEtat
            FROM utilisateur u
            JOIN stage s ON u.id = s.Id_Etudiant
            JOIN inscription i ON i.Id_Etudiant = u.Id
            JOIN departement d ON i.Id_Departement = d.Id_Departement
            WHERE Id_Enseignant_1 = :idTuteur
        ';
        $stmt = $this->bd->prepare($sql); // ici tu utilises bien "bd"
        $stmt->execute(['idTuteur' => $idTuteur]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}



/*
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
}*/
?>