<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'pedagogique') {
    header('Location: login.php');
    exit();
}

require_once '../model/TuteurPedagogiqueModel.php';

$model = new TuteurPedagogiqueModel();
$etudiants = $model->getListeEtudiants($_SESSION['user']['id']);

require_once '../view/boardPedagogiqueView.php';
?>