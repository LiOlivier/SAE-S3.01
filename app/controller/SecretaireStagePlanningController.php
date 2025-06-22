<?php
require_once(__DIR__ . '/../models/SecretaireStagePlanningModel.php');
require_once(__DIR__ . '/../dbdata.php');

class StagePlanningController {
    private $model;

    public function __construct() {
        $this->model = new StagePlanningModel();
    }

    public function displayStagePlanning() {
        $tuteursPedagogiques = $this->model->getAllTuteursPedagogiques();
        $tuteursEntreprises = $this->model->getAllTuteursEntreprises();
        $etudiants = $this->model->getAllEtudiants();
        $stageStudents = $this->model->getAllStageStudents();
        $enseignants = $this->model->getAllEnseignants();
        $departements = $this->model->getAllDepartements();
        $annees = $this->model->getAllAnnees();
        $entreprises = $this->model->getAllEntreprises();
        require(__DIR__ . '/../views/SecretaireStagePlanningView.php');
    }

    public function addStage() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_stage'])) {
            $studentId = $_POST['student'];
            $semester = $_POST['semester'];
            $Id_Departement = $_POST['Id_Departement'];
            $startDate = $_POST['start_date'];
            $endDate = $_POST['end_date'];
            $mission = $_POST['mission'];
            $Id_Entreprise = $_POST['Id_Entreprise'];

            if ($this->model->addStage($studentId, $semester, $Id_Departement, $startDate, $endDate, $mission, $Id_Entreprise)) {
                $message = 'Le stage a été ajouté avec succès.';
            } else {
                $message = 'Erreur : L\'étudiant a déjà 2 stages ou un stage dans ce semestre.';
            }
        }
        $this->displayStagePlanning();
    }

    public function assignTuteur() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['assign_tuteur'])) {
            $studentId = $_POST['student'];
            $semester = $_POST['semester'];
            $tuteurPedagogiqueId = $_POST['tuteur_pedagogique'];
            $tuteurEntrepriseId = $_POST['tuteur_entreprise'];

            if ($this->model->assignTuteur($studentId, $semester, $tuteurPedagogiqueId, $tuteurEntrepriseId)) {
                $message = 'Les tuteurs ont été assignés avec succès.';
            } else {
                $message = 'Erreur : Aucun stage trouvé pour cet étudiant et ce semestre.';
            }
        }
        $this->displayStagePlanning();
    }

    public function assignJury() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['assign_jury'])) {
            $studentId = $_POST['student'];
            $semester = $_POST['semester'];
            $juryId = $_POST['jury'];
            $date = $_POST['date'];
            $salle_soutenance = $_POST['salle_soutenance'];

            if ($this->model->assignJury($studentId, $semester, $juryId, $date, $salle_soutenance)) {
                $message = 'Le jury a été assigné avec succès.';
            } else {
                $message = 'Erreur : Aucun stage trouvé pour cet étudiant et ce semestre.';
            }
        }
        $this->displayStagePlanning();
    }
}
?>