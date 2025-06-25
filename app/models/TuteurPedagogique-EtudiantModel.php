<?php
require_once "../config/database.php";

class TuteurPedagogiqueEtudiantModel {
    private $bd;

    public function __construct() {
        $this->bd = Database::getConnexion('mysql');
        $this->bd->query("SET NAMES 'utf8'");
    }

    public function getTuteurInfo($studentId) {
        $sql = '
            SELECT u.nom, u.prenom
            FROM utilisateur u
            JOIN stage s ON u.id = s.Id_Enseignant_1
            WHERE s.Id_Etudiant = :studentId
        ';
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getEtudiantDetails($studentId) {
        $sql = '
            SELECT 
                u.id, u.nom, u.prenom, u.email, u.telephone,
                d.Libelle,
                s.Id_Enseignant_1 as id_tuteur_pedagogique,
                s.Id_Stage as id_stage,
                CASE 
                    WHEN NOT EXISTS (
                        SELECT 1 FROM action a 
                        WHERE a.Id_Etudiant = u.Id AND a.id_type_action = 7
                    ) THEN "En attente"
                    ELSE "Tâche complète"
                END AS BordereauEtat,
                CASE 
                    WHEN NOT EXISTS (
                        SELECT 1 FROM action a 
                        WHERE a.Id_Etudiant = u.Id AND a.id_type_action = 9
                    ) THEN "En attente"
                    ELSE "Tâche complète"
                END AS ConventionEtat,
                CASE 
                    WHEN NOT EXISTS (
                        SELECT 1 FROM action a 
                        WHERE a.Id_Etudiant = u.Id AND a.id_type_action = 6
                    ) THEN "En attente"
                    ELSE "Tâche complète"
                END AS RapportEtat
            FROM utilisateur u
            JOIN stage s ON u.id = s.Id_Etudiant
            JOIN inscription i ON i.Id_Etudiant = u.Id
            JOIN departement d ON i.Id_Departement = d.Id_Departement
            WHERE u.Id = :studentId
        ';
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
