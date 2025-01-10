<?php
require "../config/database.php";

class Utilisateur {
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
    public function login($login, $password)
    {
        $sql = "SELECT * FROM $this->table WHERE login = :login AND password = :password";
        $query = $this->db->prepare($sql);
        $query->execute(array('login' => $login, 'password' => $password));
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
    
    

}
