<?php session_start(); //commencer la session
error_reporting(E_ALL);
ini_set("display_errors", 1);
require "../model/utilisateur.php"; //creation de session [user]
require "../model/typeAction.php";