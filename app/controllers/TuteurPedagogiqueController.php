<?php
require_once(__DIR__ . '/../models/TuteurPedagogiqueModel.php');
require_once(__DIR__ . '/../dbdata.php');

class TuteurPedagogiqueController {
    private $model;

    public function __construct() {
        global $dsn, $login, $mdp;
        $this->model = new TuteurPedagogiqueModel($dsn, $login, $mdp);
    }

    public function displayTuteursPedagogiques() {
        $tuteursPedagogiques = $this->model->getAllTuteursPedagogiques();
        require(__DIR__ . '/../views/tuteursPedagogiquesView.php');
    }
}
?>