<?php
require_once(__DIR__ . '/controller/DashboardController.php');

$controller = new DashboardController();
$controller->displayDashboard();
?>