<?php
session_start();
require_once(__DIR__ . '/controllers/StageController.php');

$controller = new StageController();
$controller->displayStages();
?>