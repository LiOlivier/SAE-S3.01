<?php
require_once(__DIR__ . '/controllers/TuteurPedagogiqueController.php');

$controller = new TuteurPedagogiqueController();
$controller->displayTuteursPedagogiques();
?>