<?php 
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
require "../model/utilisateur.php";
require "../model/typeAction.php";

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
$userModel = new Utilisateur();
$actionModel = new typeAction();


$idEtudiant = $_SESSION['user']['id'];

$id_Pedagogique = $userModel->getPedagogiqueById($idEtudiant);

$actions = $actionModel->getActionByEnseignantId($id_Pedagogique["id_Pedagogique"]);
?>