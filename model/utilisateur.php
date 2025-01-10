<?php
require "../config/database.php";

class Utilisateur {
    protected $table = "Utilisateur";
    protected $db;
    
   public function __construct($dbType = 'mysql')
    {
        $this->db = Database::getConnexion($dbType);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM $this->table";
        $query = $this->db->query($sql);
        return $query->fetchAll();
    }

}
