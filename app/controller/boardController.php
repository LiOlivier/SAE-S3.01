<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
require "../model/utilisateur.php";
require "../model/typeAction.php";

if (!isset($_SESSION['user'])) {
    // Redirige vers la page de connexion si non authentifié
    header('Location: login.php');
    exit();
}

$idEtudiant = $_SESSION['user']['id'];
$userModel = new Utilisateur();
$actionModel = new typeAction();


$enseignants = $userModel->getPedagogiqueByEtudiant($idEtudiant);
$tuteurs = $userModel->getTuteursByEtudiant($idEtudiant);
$id_Pedagogique = $userModel->getPedagogiqueById($idEtudiant);
$actions = $actionModel->getActionByEnseignantId($idEtudiant);

