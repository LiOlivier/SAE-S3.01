<?php
require_once "../config/database.php";
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
        //SELECT libelle, LienModeleDoc, Etat FROM typeaction WHERE id_Enseignant = 2 AND Executant = "Etudiant";
        $sql = "SELECT libelle, LienModeleDoc, Etat FROM $this->table WHERE id_Enseignant = :userId AND Executant = 'Etudiant'";
        $query = $this->db->prepare($sql);
        $query->execute(['userId' => $userId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>