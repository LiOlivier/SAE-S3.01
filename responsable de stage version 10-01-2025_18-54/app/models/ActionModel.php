<?php
require_once 'database.php';

class ActionModel {
    private $conn;
    private $table = 'Action';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Get all actions
    public function getAllActions() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get action by ID
    public function getActionById($id) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE Id_Action = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create new action
    public function createAction($data) {
        $query = 'INSERT INTO ' . $this->table . ' (annee, Id_Departement, numSemestre, Id_Etudiant, Id_Stage, date_realisation, lienDocument, Id_TypeAction, Id) VALUES (:annee, :Id_Departement, :numSemestre, :Id_Etudiant, :Id_Stage, :date_realisation, :lienDocument, :Id_TypeAction, :Id)';
        $stmt = $this->conn->prepare($query);

        // Bind data
        $stmt->bindParam(':annee', $data['annee']);
        $stmt->bindParam(':Id_Departement', $data['Id_Departement']);
        $stmt->bindParam(':numSemestre', $data['numSemestre']);
        $stmt->bindParam(':Id_Etudiant', $data['Id_Etudiant']);
        $stmt->bindParam(':Id_Stage', $data['Id_Stage']);
        $stmt->bindParam(':date_realisation', $data['date_realisation']);
        $stmt->bindParam(':lienDocument', $data['lienDocument']);
        $stmt->bindParam(':Id_TypeAction', $data['Id_TypeAction']);
        $stmt->bindParam(':Id', $data['Id']);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Update action
    public function updateAction($id, $data) {
        $query = 'UPDATE ' . $this->table . ' SET annee = :annee, Id_Departement = :Id_Departement, numSemestre = :numSemestre, Id_Etudiant = :Id_Etudiant, Id_Stage = :Id_Stage, date_realisation = :date_realisation, lienDocument = :lienDocument, Id_TypeAction = :Id_TypeAction, Id = :Id WHERE Id_Action = :id';
        $stmt = $this->conn->prepare($query);

        // Bind data
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':annee', $data['annee']);
        $stmt->bindParam(':Id_Departement', $data['Id_Departement']);
        $stmt->bindParam(':numSemestre', $data['numSemestre']);
        $stmt->bindParam(':Id_Etudiant', $data['Id_Etudiant']);
        $stmt->bindParam(':Id_Stage', $data['Id_Stage']);
        $stmt->bindParam(':date_realisation', $data['date_realisation']);
        $stmt->bindParam(':lienDocument', $data['lienDocument']);
        $stmt->bindParam(':Id_TypeAction', $data['Id_TypeAction']);
        $stmt->bindParam(':Id', $data['Id']);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Delete action
    public function deleteAction($id) {
        $query = 'DELETE FROM ' . $this->table . ' WHERE Id_Action = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>