<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
<<<<<<< HEAD
require "models/utilisateur.php";
require "models/typeAction.php";
=======
require "../model/utilisateur.php";
require "../model/typeAction.php";
>>>>>>> 145365576bb88050561c7ed14ad2574d84df58c3

if (!isset($_SESSION['user'])) {
    // Redirige vers la page de connexion si non authentifié
    header('Location: login.php');
    exit();
}
