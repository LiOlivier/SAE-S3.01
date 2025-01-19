<?php

class TuteurEntrepriseModel {
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

    public function getAllTuteursEntreprise() {
        $query = 'SELECT Utilisateur.nom, Utilisateur.prenom, Utilisateur.email, Utilisateur.telephone, Tuteur_Entreprise.Id_Entreprise 
                  FROM Tuteur_Entreprise 
                  JOIN Utilisateur ON Tuteur_Entreprise.Id_Tuteur_Entreprise = Utilisateur.id';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>