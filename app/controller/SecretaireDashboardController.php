<?php
require_once(__DIR__ . '/../models/SecretaireDashboardModel.php');
require_once(__DIR__ . '/../dbdata.php');
require_once(__DIR__ . '/../controller/sessionController.php');

class DashboardController {
    private $model;

    public function __construct() {
        $this->model = new DashboardModel();
    }

    public function displayDashboard() {
        $overdueReportsCount = $this->model->getOverdueReportsCount();
        $upcomingSoutenancesCount = $this->model->getUpcomingSoutenancesCount();
        $stagesWithoutJuryCount = $this->model->getStagesWithoutJuryCount();
        $totalStudentsCount = $this->model->getTotalStudentsCount();
        $totalStagesCount = $this->model->getTotalStagesCount();
        $recentNotifications = $this->model->getRecentNotifications();
        require(__DIR__ . '/../views/secretaireDashboardView.php');
    }
}
?>