
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




/*
require_once(__DIR__ . '/../models/TuteurPedagogiqueModel.php');
require_once(__DIR__ . '/../dbdata.php');
require_once "../models/TuteurPedagogique-EtudiantModel.php";


class TuteurPedagogiqueController {
    private $model;

    public function __construct() {
        $this->model = new TuteurPedagogiqueModel();
    }

    public function displayTuteursPedagogiques() {
        $tuteursPedagogiques = $this->model->getAllTuteursPedagogiques();
        require(__DIR__ . '/../views/tuteursPedagogiquesView.php');
    }

    public function afficherDocumentEtudiant($studentId) {
        $model = new TuteurPedagogiqueEtudiantModel();
        $student = $model->getEtudiantDetails($studentId);
        $dataUser = $model->getTuteurInfos($studentId);

        if ($student) {
            require "../views/TuteurPedagogique-EtudiantModel.php";
        } else {
            echo "<p>Les détails de l'étudiant sont introuvables.</p>";
        }
    }
}*
?>