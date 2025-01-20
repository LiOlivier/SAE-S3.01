<?php



$utilisateur = new Utilisateur();

$id=$_SESSION['user']['id'];
$idTuteur = $utilisateur->getTuteurByUserId($id);


$liste_eleve = $utilisateur->getEleveParTuteur($idTuteur);

$tuteur_ped = $utilisateur->getEnseignantParTuteur($idTuteur);
?>