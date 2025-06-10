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

    
}
