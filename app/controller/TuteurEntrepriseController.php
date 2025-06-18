<?php
require_once(__DIR__ . '/../models/TuteurEntrepriseModel.php');
require_once(__DIR__ . '/../dbdata.php');

class TuteurEntrepriseController {
    private $model;

    public function __construct() {
        $this->model = new TuteurEntrepriseModel();
    }

    public function displayTuteursEntreprise() {
        $tuteursEntreprise = $this->model->getAllTuteursEntreprise();
        require(__DIR__ . '/../views/tuteursEntrepriseView.php');
    }
}
?>