<?php

class Model
{

    private $bd;

    private static $instance = null;

 
    private function __construct()
    {
        require("credentials.php");
        $this->bd = new PDO($dsn, $login, $mdp);
        $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->bd->query("SET nameS 'utf8'");
    }

    /**
     * Méthode permettant de récupérer un modèle car le constructeur est privé (Implémentation du Design Pattern Singleton)
     */
    public static function getModel()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getEmail($id){
        $requete = $this->bd->prepare('SELECT email FROM Utilisateur WHERE id = :id');
        $requete->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $requete->execute();

        $result = $requete ->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['email'] : null;
    }

    public function getInformationEleve($id_eleve){
        $requete = $this->bd->prepare('SELECT * FROM Utilisateur WHERE Id = :id_eleve');
        $requete->bindValue(':id_eleve', $id_eleve, PDO::PARAM_INT);
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getEleveEnStage($id_tuteur) {
        $requete = $this->bd->prepare('SELECT Id_Etudiant FROM Stage WHERE Id_Tuteur_Entreprise = :id_tuteur');
        $requete->bindValue(':id_tuteur', $id_tuteur, PDO::PARAM_INT);
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function getEnseignant($id_tuteur){
        $requete = $this->bd->prepare('SELECT Id_Enseignant_1 FROM Stage WHERE id_Tuteur_Entreprise = :id_tuteur');
        $requete->bindValue(':id_tuteur', $id_tuteur, PDO::PARAM_INT);
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
}