<?php
session_start();
require_once(__DIR__ . '/controller/TuteurEntrepriseController.php');

$controller = new TuteurEntrepriseController();
$controller->displayTuteursEntreprise();
?>