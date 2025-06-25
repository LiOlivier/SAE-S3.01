<?php
session_start();
require_once __DIR__ . '/../models/TuteurPedagogique-EtudiantModel.php';


if (!isset($_GET['id'])) {
    echo "<p>ID de l'étudiant non fourni.</p>";
    exit;
}

$studentId = $_GET['id'];
$model = new TuteurPedagogiqueEtudiantModel();

try {
    $student = $model->getEtudiantDetails($studentId);
    $tuteur = $model->getTuteurInfo($studentId);

    if ($student) {
        require __DIR__ . "/../views/TuteurPedagogique-EtudiantView.php";
    } else {
        echo "<p>Les détails de l'étudiant sont introuvables.</p>";
    }
} catch (PDOException $e) {
    echo "<p>Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
