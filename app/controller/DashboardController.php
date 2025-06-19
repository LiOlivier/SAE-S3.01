<?php
require_once(__DIR__ . '/../models/DashboardModel.php');
require_once(__DIR__ . '/../dbdata.php');
require_once(__DIR__ . '/../controller/sessionController.php');

class DashboardController {
    private $model;

    public function __construct() {
<<<<<<< HEAD
        $this->model = new DashboardModel();
=======
        global $dsn, $login, $mdp;
        $this->model = new DashboardModel($dsn, $login, $mdp);
>>>>>>> 145365576bb88050561c7ed14ad2574d84df58c3
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