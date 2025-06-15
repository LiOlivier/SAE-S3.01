<?php
session_start();
require_once(__DIR__ . '/controller/SecretaireTuteurEntrepriseController.php');

$controller = new TuteurEntrepriseController();
$controller->displayTuteursEntreprise();
?>