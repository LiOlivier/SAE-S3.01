<?php
require_once 'database.php';

class StageModel {
    private $conn;
    private $table = 'Stage';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Get all stages
    public function getAllStages() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get stage by ID
    public function getStageById($id) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE Id_Stage = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create new stage
    public function createStage($data) {
        $query = 'INSERT INTO ' . $this->table . ' (annee, Id_Departement, numSemestre, Id_Etudiant, date_debut, date_fin, mission, date_soutenance, salle_soutenance, Id_Enseignant_1, Id_Tuteur_Entreprise, Id_Enseignant_2) VALUES (:annee, :Id_Departement, :numSemestre, :Id_Etudiant, :date_debut, :date_fin, :mission, :date_soutenance, :salle_soutenance, :Id_Enseignant_1, :Id_Tuteur_Entreprise, :Id_Enseignant_2)';
        $stmt = $this->conn->prepare($query);

        // Bind data
        $stmt->bindParam(':annee', $data['annee']);
        $stmt->bindParam(':Id_Departement', $data['Id_Departement']);
        $stmt->bindParam(':numSemestre', $data['numSemestre']);
        $stmt->bindParam(':Id_Etudiant', $data['Id_Etudiant']);
        $stmt->bindParam(':date_debut', $data['date_debut']);
        $stmt->bindParam(':date_fin', $data['date_fin']);
        $stmt->bindParam(':mission', $data['mission']);
        $stmt->bindParam(':date_soutenance', $data['date_soutenance']);
        $stmt->bindParam(':salle_soutenance', $data['salle_soutenance']);
        $stmt->bindParam(':Id_Enseignant_1', $data['Id_Enseignant_1']);
        $stmt->bindParam(':Id_Tuteur_Entreprise', $data['Id_Tuteur_Entreprise']);
        $stmt->bindParam(':Id_Enseignant_2', $data['Id_Enseignant_2']);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Update stage
    public function updateStage($id, $data) {
        $query = 'UPDATE ' . $this->table . ' SET annee = :annee, Id_Departement = :Id_Departement, numSemestre = :numSemestre, Id_Etudiant = :Id_Etudiant, date_debut = :date_debut, date_fin = :date_fin, mission = :mission, date_soutenance = :date_soutenance, salle_soutenance = :salle_soutenance, Id_Enseignant_1 = :Id_Enseignant_1, Id_Tuteur_Entreprise = :Id_Tuteur_Entreprise, Id_Enseignant_2 = :Id_Enseignant_2 WHERE Id_Stage = :id';
        $stmt = $this->conn->prepare($query);

        // Bind data
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':annee', $data['annee']);
        $stmt->bindParam(':Id_Departement', $data['Id_Departement']);
        $stmt->bindParam(':numSemestre', $data['numSemestre']);
        $stmt->bindParam(':Id_Etudiant', $data['Id_Etudiant']);
        $stmt->bindParam(':date_debut', $data['date_debut']);
        $stmt->bindParam(':date_fin', $data['date_fin']);
        $stmt->bindParam(':mission', $data['mission']);
        $stmt->bindParam(':date_soutenance', $data['date_soutenance']);
        $stmt->bindParam(':salle_soutenance', $data['salle_soutenance']);
        $stmt->bindParam(':Id_Enseignant_1', $data['Id_Enseignant_1']);
        $stmt->bindParam(':Id_Tuteur_Entreprise', $data['Id_Tuteur_Entreprise']);
        $stmt->bindParam(':Id_Enseignant_2', $data['Id_Enseignant_2']);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Delete stage
    public function deleteStage($id) {
        $query = 'DELETE FROM ' . $this->table . ' WHERE Id_Stage = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>