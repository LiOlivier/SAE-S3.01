<?php
require_once(__DIR__ . '/../dbdata.php');
require_once(__DIR__ . '/../models/SecretaireEtudiantModel.php');

class EtudiantController {
    private $model;

    public function __construct() {
        try {
            $this->model = new EtudiantModel();
        } catch (Exception $e) {
            die('Erreur lors de l\'initialisation du modèle : ' . $e->getMessage());
        }
    }

    public function displayEtudiants() {
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $sortColumn = isset($_GET['sort']) ? $_GET['sort'] : 'nom';
        $sortOrder = isset($_GET['order']) && in_array(strtoupper($_GET['order']), ['ASC', 'DESC']) ? strtoupper($_GET['order']) : 'ASC';
        $department = isset($_GET['department']) ? $_GET['department'] : '';
        $semester = isset($_GET['semester']) ? $_GET['semester'] : '';
        $year = isset($_GET['year']) ? $_GET['year'] : '';
        $filter = isset($_GET['filter']) && in_array($_GET['filter'], ['active', 'inactive']) ? $_GET['filter'] : 'all';
        $rowsPerPage = isset($_GET['rows']) && in_array($_GET['rows'], [5, 10, 25, 50]) ? (int)$_GET['rows'] : 10;
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $offset = ($page - 1) * $rowsPerPage;

        // Force reload if filter changes to ensure fresh data
        if (isset($_GET['filter']) && !empty($_GET['filter'])) {
            header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
            header('Pragma: no-cache');
            header('Expires: 0');
        }

        try {
            $etudiants = $this->model->getAllEtudiants($search, $sortColumn, $sortOrder, $department, $semester, $year, $filter, $rowsPerPage, $offset);
            $totalEtudiants = $this->model->getTotalEtudiants($search, $department, $semester, $year, $filter);
            $departments = $this->model->getDepartments();
            $semesters = $this->model->getSemesters();
            $years = $this->model->getYears();
            $totalPages = ceil($totalEtudiants / $rowsPerPage);
        } catch (Exception $e) {
            die('Erreur lors de la récupération des données : ' . $e->getMessage());
        }

        require(__DIR__ . '/../views/secretaireEtudiantsView.php');
    }
}
?>