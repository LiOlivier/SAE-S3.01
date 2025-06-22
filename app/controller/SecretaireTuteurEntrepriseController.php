<?php
require_once(__DIR__ . '/../models/SecretaireTuteurEntrepriseModel.php');
require_once(__DIR__ . '/../dbdata.php');

class TuteurEntrepriseController {
    private $model;

    public function __construct() {
        $this->model = new TuteurEntrepriseModel();
    }

    public function displayTuteursEntreprise() {
        $tuteursEntreprise = $this->model->getAllTuteursEntreprise();
        $totalPages = ceil(count($tuteursEntreprise) / 10); // Basic pagination, adjust as needed
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $rowsPerPage = isset($_GET['rows']) && in_array((int)$_GET['rows'], [5, 10, 25, 50]) ? (int)$_GET['rows'] : 10;
        $offset = ($page - 1) * $rowsPerPage;
        $tuteursEntreprise = array_slice($tuteursEntreprise, $offset, $rowsPerPage);
        require(__DIR__ . '/../views/secretaireTuteursEntrepriseView.php');
    }
}
?>