<?php
require_once(__DIR__ . '/../dbdata.php');
require_once(__DIR__ . '/../models/SecretaireEtudiantModel.php');

class EtudiantController {
    private $model;

    public function __construct() {
        $this->model = new EtudiantModel();
    }

    public function displayEtudiants() {
        $etudiants = $this->model->getAllEtudiants();
        require(__DIR__ . '/../views/secretaireEtudiantsView.php');
    }
}
?>