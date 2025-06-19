<?php
require_once(__DIR__ . '/../dbdata.php');
require_once(__DIR__ . '/../models/EtudiantModel.php');

class EtudiantController {
    private $model;

    public function __construct() {
<<<<<<< HEAD
        $this->model = new EtudiantModel();
=======
        global $dsn, $login, $mdp;
        $this->model = new EtudiantModel($dsn, $login, $mdp);
>>>>>>> 145365576bb88050561c7ed14ad2574d84df58c3
    }

    public function displayEtudiants() {
        $etudiants = $this->model->getAllEtudiants();
        require(__DIR__ . '/../views/etudiantsView.php');
    }
}
?>