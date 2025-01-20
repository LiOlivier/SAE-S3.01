<?php
session_start();
require_once(__DIR__ . '/controllers/StagePlanningController.php');

$controller = new StagePlanningController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_stage'])) {
        $controller->addStage();
    } elseif (isset($_POST['assign_tuteur'])) {
        $controller->assignTuteur();
    } elseif (isset($_POST['assign_jury'])) {
        $controller->assignJury();
    }
} else {
    $controller->displayStagePlanning();
}
?>