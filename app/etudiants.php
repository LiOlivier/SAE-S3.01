<?php
session_start();
require_once(__DIR__ . '/controllers/EtudiantController.php');

$controller = new EtudiantController();
$controller->displayEtudiants();
?>