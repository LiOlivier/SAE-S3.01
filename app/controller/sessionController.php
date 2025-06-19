<?php 
session_start(); //commencer la session
error_reporting(E_ALL);
ini_set("display_errors", 1);
<<<<<<< HEAD
require "models/utilisateur.php"; //creation de session [user]
require "models/typeAction.php";
=======
require "../model/utilisateur.php"; //creation de session [user]
require "../model/typeAction.php";
>>>>>>> 145365576bb88050561c7ed14ad2574d84df58c3
 if (!isset($_SESSION['user'])) {
    header('Location: login.php');
     exit();
 } 