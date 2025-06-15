<?php
session_start();
require_once(__DIR__ . '/controller/SecretaireEtudiantController.php');

$controller = new EtudiantController();
$controller->displayEtudiants();
?>