<?php 

require (__DIR__."//../models/ChefDptModel.php");

$model = Model::getModel();

$listeS4 = $model->getListEtudiants(4, 1);
$listeS6 = $model->getListEtudiants(6, 1);
?>
