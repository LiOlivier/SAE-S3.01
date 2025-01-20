<?php
session_start();
require_once(__DIR__ . '/controllers/TuteurEntrepriseController.php');

$controller = new TuteurEntrepriseController();
$controller->displayTuteursEntreprise();
?>