<?php
require_once(__DIR__ . '/../models/TuteurModel.php');
require_once(__DIR__ . '/../dbdata.php');

class TuteurController {
    private $model;
    private $message;

    public function __construct() {
        global $dsn, $login, $mdp;
        $this->model = new TuteurModel($dsn, $login, $mdp);
    }

    public function displayTuteurs() {
        $enseignants = $this->model->getAllEnseignants();
        $entreprises = $this->model->getAllEntreprises();
        $message = $this->message;
        require(__DIR__ . '/../views/tuteurView.php');
    }

    public function addTuteurPedagogique() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_tuteur_pedagogique'])) {
            $enseignantId = $_POST['enseignant'];
            if ($this->model->addTuteurPedagogique($enseignantId)) {
                $this->message = 'Le tuteur pédagogique a été ajouté avec succès.';
            }
        }
        $this->displayTuteurs();
    }

    public function addTuteurEntreprise() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_tuteur_entreprise'])) {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $telephone = $_POST['telephone'];
            $login = $_POST['login'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $entrepriseId = $_POST['entreprise'];
            if ($this->model->addTuteurEntreprise($nom, $prenom, $email, $telephone, $login, $password, $entrepriseId)) {
                $this->message = 'Le tuteur entreprise a été ajouté avec succès.';
            }
        }
        $this->displayTuteurs();
    }
}
?>