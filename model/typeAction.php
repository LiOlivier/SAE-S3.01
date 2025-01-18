<?php
require_once(__DIR__ . '/../config/database.php');
error_reporting(E_ALL);
ini_set("display_errors", 1);

class TypeAction
{
    protected $table = "typeaction";
    protected $db;

    public function __construct($dbType = 'mysql')
    {
        $this->db = Database::getConnexion($dbType);
    }

    public function getActionByEnseignantId($userId) { //recupere toute les actions qu'un enseignant a créer du point de vue de etudiant
        //SELECT libelle, LienModeleDoc, Etat FROM typeaction WHERE id_Pedagogique = 2 AND Executant = "Etudiant";
        $sql = "SELECT libelle, LienModeleDoc, Etat, dateLimite, id_TypeAction FROM $this->table WHERE id_Pedagogique = :userId AND Executant = 'Etudiant'";
        $query = $this->db->prepare($sql);
        $query->execute(['userId' => $userId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getActionByEntreprise($id_Tuteur_Entreprise){  // recuperer les action initier par l'entreprise en direction d'un enseignant
        $sql = "SELECT libelle, LienModeleDoc, Etat, id_TypeAction FROM $this->table WHERE id_Tuteur_Entreprise = :id_Tuteur_Entreprise AND Executant = 'Tuteur Pédagogique'";
        $query = $this->db->prepare($sql);
        $query->execute(['id_Tuteur_Entreprise' => $id_Tuteur_Entreprise]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


}
?>