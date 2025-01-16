<?php
require "../config/database.php";

class Utilisateur
{
    protected $table = "utilisateur";
    protected $db;

    public function __construct($dbType = 'mysql')
    {
        $this->db = Database::getConnexion($dbType);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM $this->table";
        $query = $this->db->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function login($login)
    {
        $sql = "SELECT * FROM $this->table WHERE login = :login";
        $query = $this->db->prepare($sql);
        $query->execute(['login' => $login]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function register($data)
    {
        $sql = "INSERT INTO $this->table (nom, prenom, login, password, email, telephone) 
                    VALUES (:nom, :prenom, :login, :password, :email, :tel)";
        $query = $this->db->prepare($sql);
        $query->execute($data);

        return $this->db->lastInsertId();
    }

    public function getEnseignantsByEtudiant($idEtudiant)
    {
        $sql = "SELECT u.prenom, u.nom, u.email, u.telephone
            FROM $this->table u
            INNER JOIN enseignant e ON u.id = e.id_Enseignant
            WHERE e.id_Etudiant = :idEtudiant";
        $query = $this->db->prepare($sql);
        $query->execute(['idEtudiant' => $idEtudiant]);
        return $query->fetchAll(PDO::FETCH_ASSOC); // Retourne un tableau d'enseignants
    }
    public function getTuteursByEtudiant($idEtudiant)
    {
        $sql = "SELECT u.prenom, u.nom, u.email, u.telephone
            FROM $this->table u
            INNER JOIN tuteur_entreprise t ON u.id = t.id_Tuteur_Entreprise
            WHERE t.id_Etudiant = :idEtudiant";
        $query = $this->db->prepare($sql);
        $query->execute(['idEtudiant' => $idEtudiant]);
        return $query->fetchAll(PDO::FETCH_ASSOC); // Retourne un tableau de tuteur
    }

    public function cleanXSS($value)
    {

        $first = strpos($value, '<', 0);
        $last = strrpos($value, '>', 0);

        if ($first && $last) {

            $cleaner = substr($value, $first, $last - $first + 1);
            $cleanString = str_replace($cleaner, "", $value);

            return $cleanString;
        } elseif ($first && !$last) {

            $cleaner = substr($value, $first);
            $cleanString = str_replace($cleaner, "", $value);

            return $cleanString;
        } elseif (!$first && $last) {

            $cleaner = substr($value, 0, $last - $first + 1);
            $cleanString = str_replace($cleaner, "", $value);

            return $cleanString;
        } else {

            return $value;
        }
    }
}
