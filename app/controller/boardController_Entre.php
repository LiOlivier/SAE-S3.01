<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
<<<<<<< HEAD
if (file_exists(__DIR__ . '//models/utilisateur.php')) {
=======
if (file_exists(__DIR__ . '/../model/utilisateur.php')) {
>>>>>>> 145365576bb88050561c7ed14ad2574d84df58c3
    echo "Le fichier existe!";
} else {
    echo "Le fichier n'existe pas!";
}
<<<<<<< HEAD
require_once(__DIR__ . '//models/utilisateur.php');
require "models/typeAction.php";
=======
require_once(__DIR__ . '/../model/utilisateur.php');
require "../model/typeAction.php";
>>>>>>> 145365576bb88050561c7ed14ad2574d84df58c3

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}