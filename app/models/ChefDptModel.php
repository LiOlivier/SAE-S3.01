<?php

class Model
{

    private $bd;

    private static $instance = null;

 
    private function __construct()
    {
<<<<<<< HEAD
        require_once(__DIR__ . "/../../config/database.php"); // Inclure database.php
        $this->bd = Database::getConnexion(); // Utiliser la connexion centralisée
=======
        require(__DIR__."//../dbdata.php");
        $this->bd = new PDO($dsn, $login, $mdp);
        $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->bd->query("SET nameS 'utf8'");
>>>>>>> 145365576bb88050561c7ed14ad2574d84df58c3
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

<<<<<<< HEAD
    public function getListEtudiants($num_Semestre) {
=======
    public function getListEtudiants($numSemestre) {
>>>>>>> 145365576bb88050561c7ed14ad2574d84df58c3
        $requete = $this->bd->prepare('SELECT u.id, u.nom, u.prenom,u.email,u.telephone, d.Libelle
                            FROM utilisateur u
                            JOIN inscription i ON i.Id_Etudiant = u.Id
                            JOIN departement d ON i.Id_Departement = d.Id_Departement
<<<<<<< HEAD
                            WHERE i.num_Semestre = :num');
        $requete->bindValue(':num', $num_Semestre, PDO::PARAM_INT);
=======
                            WHERE i.numSemestre = :num');
        $requete->bindValue(':num', $numSemestre, PDO::PARAM_INT);
>>>>>>> 145365576bb88050561c7ed14ad2574d84df58c3
        $requete->execute();
        $tab = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $tab;
    }

<<<<<<< HEAD
    public function getNbEtudiants($num_Semestre) {
        $requete = $this->bd->prepare('SELECT COUNT(*) FROM Inscription WHERE num_Semestre = :num');
        $requete->bindValue(':num', $num_Semestre, PDO::PARAM_INT);
=======
    public function getNbEtudiants($numSemestre) {
        $requete = $this->bd->prepare('SELECT COUNT(*) FROM Inscription WHERE numSemestre = :num');
        $requete->bindValue(':num', $numSemestre, PDO::PARAM_INT);
>>>>>>> 145365576bb88050561c7ed14ad2574d84df58c3
        $requete->execute();
        $tab = $requete->fetch(PDO::FETCH_ASSOC);
        return $tab["COUNT(*)"];
    }
}
