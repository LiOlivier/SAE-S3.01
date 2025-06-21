<?php
require_once(__DIR__ . '/../models/SecretaireTuteurPedagogiqueModel.php');
require_once(__DIR__ . '/../dbdata.php');

class TuteurPedagogiqueController {
    private $model;

    public function __construct() {
        $this->model = new TuteurPedagogiqueModel();
    }

    public function displayTuteursPedagogiques() {
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $rowsPerPage = isset($_GET['rows']) && in_array((int)$_GET['rows'], [5, 10, 25, 50]) ? (int)$_GET['rows'] : 10;
        $offset = ($page - 1) * $rowsPerPage;

        $tutorsPedagogiques = $this->model->getAllTuteursPedagogiques($offset, $rowsPerPage);
        $totalRows = $this->model->getTotalTuteursPedagogiques();
        $totalPages = max(1, ceil($totalRows / $rowsPerPage));

        require(__DIR__ . '/../views/secretaireTuteursPedagogiquesView.php');
    }
}
?>