<?php

class EtudiantModel {
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

    public function getAllEtudiants() {
        $query = 'SELECT Utilisateur.nom, Utilisateur.prenom, Utilisateur.email, Utilisateur.telephone, Etudiant.id_Etudiant 
                  FROM Etudiant 
                  JOIN Utilisateur ON Etudiant.id_Etudiant = Utilisateur.id';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>