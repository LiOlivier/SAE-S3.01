<?php
require_once(__DIR__ . '/../models/SecretaireStageModel.php');
require_once(__DIR__ . '/../dbdata.php');

class StageController {
    private $model;

    public function __construct() {
        $this->model = new StageModel();
    }

    public function displayStages() {
        // Get filter and sort parameters
        $department = isset($_GET['department']) && is_numeric($_GET['department']) ? (int)$_GET['department'] : null;
        $year = isset($_GET['year']) && is_numeric($_GET['year']) ? (int)$_GET['year'] : null;
        $search = isset($_GET['search']) ? trim($_GET['search']) : null;
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'student_name';
        $order = isset($_GET['order']) && in_array(strtoupper($_GET['order']), ['ASC', 'DESC']) ? strtoupper($_GET['order']) : 'ASC';

        // Fetch data
        $stages = $this->model->getAllStages($department, $year, $search, $sort, $order);
        $departments = $this->model->getDepartments();
        $years = $this->model->getYears();

        // Load view with data
        require(__DIR__ . '/../views/secretaireStagesView.php');
    }
}
?>