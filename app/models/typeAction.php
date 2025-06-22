<?php
require_once __DIR__ . '/../../config/database.php';
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
        
        $sql = "SELECT libelle, Etat, lien_modele_doc, delai_limite, t.id_type_action, t.requiert_doc FROM $this->table t JOIN action a USING(id_type_action) WHERE a.id_Etudiant = :userId AND t.Executant = 'Etudiant'";
        $query = $this->db->prepare($sql);
        $query->execute(['userId' => $userId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
     }
   
    
    public function getActionByEntreprise($id_Tuteur_Entreprise){  
        $sql = "SELECT libelle, Etat, lien_modele_doc, t.id_type_action FROM $this->table t JOIN action a USING(id_type_action) WHERE a.id_Tuteur_Entreprise = :id_Tuteur_Entreprise AND t.Executant = 'Tuteur Pédagogique'";
        $query = $this->db->prepare($sql);
        $query->execute(['id_Tuteur_Entreprise' => $id_Tuteur_Entreprise]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function updateDocument($idAction, $libelle) {
        $sql = "UPDATE action SET lien_document = :libelle, Etat = 'En attente' WHERE id_type_action = :idAction";
        $query = $this->db->prepare($sql);
        $query->execute([
            'libelle' => $libelle,
            'idAction' => $idAction
        ]);
    }

    public  function selectActionById($idAction){
        $sql = "SELECT lien_modele_doc FROM $this->table WHERE id_type_action = :idAction";
        $query = $this->db->prepare($sql);
        $query->execute(['idAction' => $idAction]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getUploadedDocumentByActionId($idAction) {
        $sql = "SELECT t.dateLimite, a.etat 
                FROM typeaction t 
                LEFT JOIN action a ON t.Id_TypeAction = a.Id_TypeAction 
                WHERE a.id_action = :idAction OR a.id_action IS NULL";
        $query = $this->db->prepare($sql);
        $query->execute(['idAction' => $idAction]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    
}
?>