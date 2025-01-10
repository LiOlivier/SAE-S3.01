<?php 

require ("Model.php");


$model = Model::getModel();

$id_tut = 9;
$eleve_stage = $model->getEleveEnStage($id_tut);

if (isset($eleve_stage[0])) {
    $eleve1 = $model->getEmail($eleve_stage[0]['Id_Etudiant']);
}

if (isset($eleve_stage[1])) {
    $eleve2 = $model->getEmail($eleve_stage[1]['Id_Etudiant']);
}
$tuteur_entreprise = $model->getEnseignant($id_tut);


