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

    public function getDpt($idEnseignant) {
        $requete = $this->bd->prepare(('SELECT id_departement FROM departement WHERE id_enseignant = :id'));
        $requete->bindValue(':id', $idEnseignant, PDO::PARAM_INT);
        $requete->execute();
        $tab = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $tab;
    }
    
    public function getListEtudiants($numSemestre, $idDepartement) {
        $requete = $this->bd->prepare('SELECT u.id, u.nom, u.prenom,u.email,u.telephone, d.Libelle
                            FROM utilisateur u
                            JOIN inscription i ON i.Id_Etudiant = u.Id
                            JOIN departement d ON i.Id_Departement = d.Id_Departement
                            WHERE i.num_semestre = :num AND i.id_departement = :dpt');
        $requete->bindValue(':num', $numSemestre, PDO::PARAM_INT);
        $requete->bindValue(':dpt', $idDepartement, PDO::PARAM_INT);
        $requete->execute();
        $tab = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $tab;
    }

    public function getNbEtudiants($numSemestre, $idDepartement) {
        $requete = $this->bd->prepare('SELECT COUNT(*) FROM Inscription WHERE num_semestre = :num AND id_departement = :dpt');
        $requete->bindValue(':num', $numSemestre, PDO::PARAM_INT);
        $requete->bindValue(':dpt', $idDepartement, PDO::PARAM_INT);
        $requete->execute();
        $tab = $requete->fetch(PDO::FETCH_ASSOC);
        return $tab["COUNT(*)"];
    }
}
