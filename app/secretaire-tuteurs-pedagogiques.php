<?php
session_start();
require_once(__DIR__ . '/controller/SecretaireTuteurPedagogiqueController.php');

$controller = new TuteurPedagogiqueController();
$controller->displayTuteursPedagogiques();
?>