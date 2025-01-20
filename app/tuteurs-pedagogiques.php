<?php
session_start();
require_once(__DIR__ . '/controller/TuteurPedagogiqueController.php');

$controller = new TuteurPedagogiqueController();
$controller->displayTuteursPedagogiques();
?>