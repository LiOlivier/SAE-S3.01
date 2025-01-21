<?php

class TuteurPedagogiqueModel {
    private $db;

    public function __construct($dsn, $login, $mdp) {
        try {
            $this->db = new PDO($dsn, $login, $mdp);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->exec("USE sorbonne");
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getAllTuteursPedagogiques() {
        $query = 'SELECT nom, prenom, email, telephone 
                  FROM Utilisateur 
                  WHERE FIND_IN_SET("pedagogique", role)';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>