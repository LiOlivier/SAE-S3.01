<?php
require_once(__DIR__ . '/../models/DashboardModel.php');
require_once(__DIR__ . '/../dbdata.php');
require_once(__DIR__ . '/../controller/sessionController.php');

class DashboardController {
    private $model;

    public function __construct() {
        global $dsn, $login, $mdp;
        $this->model = new DashboardModel($dsn, $login, $mdp);
    }

    public function displayDashboard() {
        $overdueReportsCount = $this->model->getOverdueReportsCount();
        $upcomingSoutenancesCount = $this->model->getUpcomingSoutenancesCount();
        $stagesWithoutJuryCount = $this->model->getStagesWithoutJuryCount();
        $totalStudentsCount = $this->model->getTotalStudentsCount();
        $totalStagesCount = $this->model->getTotalStagesCount();
        $recentNotifications = $this->model->getRecentNotifications();
        require(__DIR__ . '/../views/dashboardView.php');
    }
}
?>