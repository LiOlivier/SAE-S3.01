<?php

class Database {

    public static function getConnexion($dbType = 'mysql') {
        $env = 'dev';

        $db_dev = array("host" => "localhost", "port" => "3306", "dbname" => "sorbonne2", "login" => "root", "password" => "root");

        $db_prod = array("host" => "localhost", "port" => "3306", "dbname" => "sorbonne2", "login" => "sorbonne", "password" => "Mn/RINhSCxLiXBid");

        switch ($env) {
            case 'dev':
                $connexion = $db_dev;
                break;

            case 'prod':
                $connexion = $db_prod;
                break;

            default:
                die("Erreur de configuration de la base de données");
        }

        if ($dbType === 'mysql') {
            $dsn = "mysql:host={$connexion['host']};port={$connexion['port']};dbname={$connexion['dbname']}";
        } elseif ($dbType === 'pgsql') {
            $dsn = "pgsql:host={$connexion['host']};port={$connexion['port']};dbname={$connexion['dbname']}";
        } else {
            die("Type de base de données non pris en charge.");
        }

        try {
            $db = new PDO($dsn, $connexion['login'], $connexion['password']);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->exec("SET NAMES 'utf8'");

            if ($dbType === 'mysql') {
                $db->exec("SET time_zone = '+01:00'");
            }

        } catch (PDOException $e) {
            $message = '[' . date('Y-m-d H:i:s') . '] ' . $e->getMessage() . "\n";
            file_put_contents('logs/errors.log', $message, FILE_APPEND);
            die("Erreur de configuration de la base de données");
        }

        return $db;
    }
}
?>
