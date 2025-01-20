<?php 

require (__DIR__."//../models/ChefDptModel.php");

$model = Model::getModel();

$listeS4 = $model->getListEtudiants(4);
$listeS6 = $model->getListEtudiants(6);
$nb_etudiants_but2 = $model->getNbEtudiants(4);
$nb_etudiants_but3 = $model->getNbEtudiants(6);
?>
