<?php 
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
<<<<<<< HEAD
require "../model/utilisateur.php";
require "../model/typeAction.php";
=======
require "models/utilisateur.php";
require "models/typeAction.php";
>>>>>>> origin/main

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
$userModel = new Utilisateur();
$actionModel = new typeAction();


$idEtudiant = $_SESSION['user']['id'];

$id_Pedagogique = $userModel->getPedagogiqueById($idEtudiant);

<<<<<<< HEAD
$actions = $actionModel->getActionByEnseignantId($id_Pedagogique["id_Pedagogique"]);
=======
$actions = $actionModel->getActionByEnseignantId($idEtudiant);
>>>>>>> origin/main
?>