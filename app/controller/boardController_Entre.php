<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
if (file_exists(__DIR__ . '//models/utilisateur.php')) {
    echo "Le fichier existe!";
} else {
    echo "Le fichier n'existe pas!";
}
require_once(__DIR__ . '//models/utilisateur.php');
require "models/typeAction.php";

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}