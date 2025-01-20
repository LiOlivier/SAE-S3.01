<?php


// Création d'une instance de la classe Utilisateur
$utilisateur = new Utilisateur();
// ID du tuteur
$id=$_SESSION['user']['id'];
$idTuteur = $utilisateur->getTuteurByUserId($id);

// Récupération des élèves en stage avec ce tuteur
$liste_eleve = $utilisateur->getEleveParTuteur($idTuteur);
// Récupération des informations sur l'enseignant lié à ce tuteur
$tuteur_ped = $utilisateur->getEnseignantParTuteur($idTuteur);
?>