<?php 

require ("Model.php");


$model = Model::getModel();

$id_tut = 9;
$liste_eleve= $model->getEleveEnStage($id_tut);
$tuteur_ped= $model->getEnseignant($id_tut);

?>


