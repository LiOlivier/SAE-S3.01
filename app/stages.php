<?php
session_start();
require_once(__DIR__ . '/controller/StageController.php');

$controller = new StageController();
$controller->displayStages();
?>