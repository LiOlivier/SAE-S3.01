<?php
session_start();
require_once(__DIR__ . '/controller/SecretaireStageController.php');

$controller = new StageController();
$controller->displayStages();
?>