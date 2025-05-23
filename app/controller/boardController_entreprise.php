<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
require "../models/TuteurEntrepriseModel.php";
//require "../models/typeAction.php";

if (!isset($_SESSION['user'])) {
    // Redirige vers la page de connexion si non authentifié
    header('Location: login.php');
    exit();
}
