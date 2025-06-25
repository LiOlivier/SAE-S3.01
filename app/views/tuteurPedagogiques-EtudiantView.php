<?php
session_start();
require_once(__DIR__ . '/controllers/TuteurPedagogiqueController.php');

if (isset($_GET['id'])) {
    $controller = new TuteurPedagogiqueController();
    $controller->afficherDocumentEtudiant($_GET['id']);
} else {
    echo "<p>ID de l'étudiant non fourni.</p>";
}
