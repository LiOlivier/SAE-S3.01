<?php

class Model
{

    private $bd;

    private static $instance = null;

 
    private function __construct()
    {
        require_once(__DIR__ . "/../../config/database.php"); // Inclure database.php
        $this->bd = Database::getConnexion(); // Utiliser la connexion centralisée
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

    public function getListEtudiants($num_Semestre) {
        $requete = $this->bd->prepare('SELECT u.id, u.nom, u.prenom,u.email,u.telephone, d.Libelle
                            FROM utilisateur u
                            JOIN inscription i ON i.Id_Etudiant = u.Id
                            JOIN departement d ON i.Id_Departement = d.Id_Departement
                            WHERE i.num_Semestre = :num');
        $requete->bindValue(':num', $num_Semestre, PDO::PARAM_INT);
        $requete->execute();
        $tab = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $tab;
    }

    public function getNbEtudiants($num_Semestre) {
        $requete = $this->bd->prepare('SELECT COUNT(*) FROM Inscription WHERE num_Semestre = :num');
        $requete->bindValue(':num', $num_Semestre, PDO::PARAM_INT);
        $requete->execute();
        $tab = $requete->fetch(PDO::FETCH_ASSOC);
        return $tab["COUNT(*)"];
    }
}
