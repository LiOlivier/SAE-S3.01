<?php
require_once(__DIR__ . '/../dbdata.php');
require_once(__DIR__ . '/../models/EtudiantModel.php');

class EtudiantController {
    private $model;

    public function __construct() {
        global $dsn, $login, $mdp;
        $this->model = new EtudiantModel($dsn, $login, $mdp);
    }

    public function displayEtudiants() {
        $etudiants = $this->model->getAllEtudiants();
        require(__DIR__ . '/../views/etudiantsView.php');
    }
}
?>