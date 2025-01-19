<?php
require_once(__DIR__ . '/controllers/TuteurController.php');

$controller = new TuteurController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_tuteur_pedagogique'])) {
        $controller->addTuteurPedagogique();
    } elseif (isset($_POST['add_tuteur_entreprise'])) {
        $controller->addTuteurEntreprise();
    }
} else {
    $controller->displayTuteurs();
}
?>