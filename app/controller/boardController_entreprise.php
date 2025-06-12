<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
<<<<<<< HEAD
=======
require "models/utilisateur.php";
require "models/typeAction.php";
>>>>>>> origin/stage

require_once(__DIR__ . "/../../model/utilisateur.php");
require_once(__DIR__ . "/../../model/typeAction.php");
require_once(__DIR__ . "/../models/TuteurEntrepriseModel.php");

// Redirection si non connecté
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Récupération de l'ID du tuteur entreprise connecté
$idTuteurEntreprise = $_SESSION['user']['id']; 

// Instanciation du modèle
$model = TuteurEntrepriseModel::getModel();

// Récupération des tuteurs pédagogiques liés
$listePedagogiques = $model->getTuteursPedagogiquesByTuteurEntreprise($idTuteurEntreprise);

// Récupération des étudiants liés
$listeEtudiants = $model->getEtudiantsByTuteurEntreprise($idTuteurEntreprise);

?>

