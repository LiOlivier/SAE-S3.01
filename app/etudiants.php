<?php
session_start();
require_once(__DIR__ . '/controller/EtudiantController.php');

$controller = new EtudiantController();
$controller->displayEtudiants();
?>