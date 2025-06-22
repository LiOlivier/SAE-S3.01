<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once(__DIR__ . "/../models/utilisateur.php");
require_once(__DIR__ . "/../models/TuteurEntrepriseModel.php");
require_once(__DIR__ . "/../models/typeAction.php");

// Redirection si non connecté
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Récupération de l'ID du tuteur entreprise connecté
$idTuteurEntreprise = $_SESSION['user']['id']; 

// Instanciation des modèles
$model = TuteurEntrepriseModel::getModel();
$actionModel = new TypeAction();

// Récupération des étudiants associés au tuteur entreprise
$listeEtudiants = $model->getEtudiantsByTuteurEntreprise($idTuteurEntreprise);

// Récupération des actions pour chaque étudiant
$etudiantsActions = [];
foreach ($listeEtudiants as $etudiant) {
    $etudiantsActions[$etudiant['id_etudiant']] = [
        'nom' => $etudiant['nom'],
        'prenom' => $etudiant['prenom'],
        'bordereau' => $actionModel->getUploadedDocumentByActionId(7), // Bordereau de stage
        'convention' => $actionModel->getUploadedDocumentByActionId(9) // Convention de stage
    ];
}
?>