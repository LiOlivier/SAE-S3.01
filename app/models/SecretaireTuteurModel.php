<?php

class TuteurModel {
    private $db;

    public function __construct() {
        try {
            require_once(__DIR__ . "/../../config/database.php"); // Inclure database.php
            $this->db = Database::getConnexion(); // Utiliser la connexion centralisée
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getAllEnseignants() {
        $query = 'SELECT Utilisateur.id, Utilisateur.nom, Utilisateur.prenom 
                  FROM Enseignant 
                  JOIN Utilisateur ON Enseignant.Id_Enseignant = Utilisateur.id';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addTuteurPedagogique($enseignantId) {
        $query = 'UPDATE Utilisateur SET role = "pedagogique" WHERE id = :enseignantId';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':enseignantId', $enseignantId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getAllEntreprises() {
        $query = 'SELECT id_entreprise FROM Entreprise';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addTuteurEntreprise($nom, $prenom, $email, $telephone, $login, $password, $entrepriseId) {
        // Ensure the login is unique
        $originalLogin = $login;
        $i = 1;
        while (true) {
            $query = 'SELECT COUNT(*) FROM Utilisateur WHERE login = :login';
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':login', $login, PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->fetchColumn() == 0) {
                break;
            }
            $login = $originalLogin . $i;
            $i++;
        }

        // Insert the new utilisateur with role 'tuteur'
        $query = 'INSERT INTO Utilisateur (nom, prenom, email, telephone, role, login, password) VALUES (:nom, :prenom, :email, :telephone, "tuteur", :login, :password)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':telephone', $telephone, PDO::PARAM_STR);
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();

        // Get the last inserted Id from Utilisateur
        $lastUserId = $this->db->lastInsertId();

        // Insert the new tuteur entreprise
        $query = 'INSERT INTO Tuteur_Entreprise (Id_Tuteur_Entreprise, id_entreprise) VALUES (:lastUserId, :entrepriseId)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':lastUserId', $lastUserId, PDO::PARAM_INT);
        $stmt->bindParam(':entrepriseId', $entrepriseId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>