<?php
require_once(__DIR__ . '/../models/TuteurEntrepriseModel.php');
require_once(__DIR__ . '/../dbdata.php');

class TuteurEntrepriseController {
    private $model;

    public function __construct() {
<<<<<<< HEAD
        $this->model = new TuteurEntrepriseModel();
=======
        global $dsn, $login, $mdp;
        $this->model = new TuteurEntrepriseModel($dsn, $login, $mdp);
>>>>>>> 145365576bb88050561c7ed14ad2574d84df58c3
    }

    public function displayTuteursEntreprise() {
        $tuteursEntreprise = $this->model->getAllTuteursEntreprise();
        require(__DIR__ . '/../views/tuteursEntrepriseView.php');
    }
}
?>