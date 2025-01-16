<?php
require "../config/database.php";


class TypeAction
{
    protected $table = "typeaction";
    protected $db;

    public function __construct($dbType = 'mysql')
    {
        $this->db = Database::getConnexion($dbType);
    }
}
