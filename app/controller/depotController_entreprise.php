<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once(__DIR__ . "/../models/utilisateur.php");
require_once(__DIR__ . "/../models/TuteurEntrepriseModel.php");
require_once(__DIR__ . "/../models/ActionModel.php");
require_once(__DIR__ . "/../models/TypeAction.php");

// Redirection si non connecté
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'tuteur_entreprise') {
    header('Location: login.php');
    exit();
}

// Récupération de l'ID du tuteur entreprise connecté
$idTuteurEntreprise = $_SESSION['user']['id']; 


$actionModel = new ActionModel();
$typeActions = ['Convention de stage', 'Rapport de stage'];

$etudiantsActions = $actionModel->getActionsParEtudiantPourTuteur($idTuteurEntreprise, $typeActions);


?>
