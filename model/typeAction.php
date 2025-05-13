<?php
require_once __DIR__ . '/../config/database.php';
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

     public function getActionByEnseignantId($userId) { 
        
        $sql = "SELECT libelle, Etat, LienModeleDoc, dateLimite, t.id_TypeAction FROM $this->table t JOIN action  a WHERE a.id_Etudiant = :userId AND t.Executant = 'Etudiant'";
        $query = $this->db->prepare($sql);
        $query->execute(['userId' => $userId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
     }
   
    
    public function getActionByEntreprise($id_Tuteur_Entreprise){  
        $sql = "SELECT libelle, Etat, LienModeleDoc, t.id_TypeAction FROM $this->table t JOIN action a WHERE a.id_Tuteur_Entreprise = :id_Tuteur_Entreprise AND t.Executant = 'Tuteur Pédagogique'";
        $query = $this->db->prepare($sql);
        $query->execute(['id_Tuteur_Entreprise' => $id_Tuteur_Entreprise]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function updateDocument($idAction, $libelle) {
        $sql = "UPDATE action SET lienDocument = :libelle, Etat = 'En attente' WHERE Id_TypeAction = :idAction";
        $query = $this->db->prepare($sql);
        $query->execute([
            'libelle' => $libelle,
            'idAction' => $idAction
        ]);
    }

    public  function selectActionById($idAction){
        $sql = "SELECT LienModeleDoc FROM $this->table WHERE id_TypeAction = :idAction";
        $query = $this->db->prepare($sql);
        $query->execute(['idAction' => $idAction]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    
}
?>