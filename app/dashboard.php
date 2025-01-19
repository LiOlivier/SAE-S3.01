<?php
require_once(__DIR__ . '/controllers/DashboardController.php');

$controller = new DashboardController();
$controller->displayDashboard();
?>