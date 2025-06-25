<?php
require_once(__DIR__ . '/../models/SecretaireTuteurEntrepriseModel.php');
require_once(__DIR__ . '/../dbdata.php');

class TuteurEntrepriseController {
    private $model;

    public function __construct() {
        $this->model = new TuteurEntrepriseModel();
    }

    public function displayTuteursEntreprise() {
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $rowsPerPage = isset($_GET['rows']) && in_array((int)$_GET['rows'], [5, 10, 25, 50]) ? (int)$_GET['rows'] : 10;
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $sort = isset($_GET['sort']) && in_array($_GET['sort'], ['nom', 'prenom', 'email', 'telephone']) ? $_GET['sort'] : 'nom';
        $order = isset($_GET['order']) && $_GET['order'] === 'desc' ? 'desc' : 'asc';
        $offset = ($page - 1) * $rowsPerPage;

        $tuteursEntreprise = $this->model->getTuteursEntrepriseFiltered($search, $sort, $order, $offset, $rowsPerPage);
        $totalRows = $this->model->countTuteursEntrepriseFiltered($search);
        $totalPages = max(1, ceil($totalRows / $rowsPerPage));

        require(__DIR__ . '/../views/secretaireTuteursEntrepriseView.php');
    }
}
?>