<?php 

require ("Model.php");


$model = Model::getModel();

$id_tut = 9;
$liste_eleve_id= $model->getEleveEnStage($id_tut);
$liste_eleve=[];

foreach($liste_eleve_id as $key => $val){
    $liste_eleve[]= $modele->getInformationEleve($id_eleve);
}





