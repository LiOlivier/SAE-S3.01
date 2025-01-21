<?php

class Model
{

    private $bd;

    private static $instance = null;

 
    private function __construct()
    {
        require(__DIR__."//../dbdata.php");
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

    public function getListEtudiants($numSemestre) {
        $requete = $this->bd->prepare('SELECT u.id, u.nom, u.prenom,u.email,u.telephone, d.Libelle
                            FROM utilisateur u
                            JOIN inscription i ON i.Id_Etudiant = u.Id
                            JOIN departement d ON i.Id_Departement = d.Id_Departement
                            WHERE i.numSemestre = :num');
        $requete->bindValue(':num', $numSemestre, PDO::PARAM_INT);
        $requete->execute();
        $tab = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $tab;
    }

    public function getNbEtudiants($numSemestre) {
        $requete = $this->bd->prepare('SELECT COUNT(*) FROM Inscription WHERE numSemestre = :num');
        $requete->bindValue(':num', $numSemestre, PDO::PARAM_INT);
        $requete->execute();
        $tab = $requete->fetch(PDO::FETCH_ASSOC);
        return $tab["COUNT(*)"];
    }
}
