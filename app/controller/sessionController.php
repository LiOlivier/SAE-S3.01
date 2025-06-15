<?php 
session_start(); //commencer la session
error_reporting(E_ALL);
ini_set("display_errors", 1);
require "models/utilisateur.php"; //creation de session [user]
require "models/typeAction.php";
 if (!isset($_SESSION['user'])) {
    header('Location: login.php');
     exit();
 } 