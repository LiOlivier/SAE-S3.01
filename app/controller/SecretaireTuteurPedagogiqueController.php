<?php
require_once(__DIR__ . '/../models/SecretaireTuteurPedagogiqueModel.php');
require_once(__DIR__ . '/../dbdata.php');

class TuteurPedagogiqueController {
    private $model;

    public function __construct() {
        $this->model = new TuteurPedagogiqueModel();
    }

    public function displayTuteursPedagogiques() {
        $tuteursPedagogiques = $this->model->getAllTuteursPedagogiques();
        require(__DIR__ . '/../views/secretaireTuteursPedagogiquesView.php');
    }
}
?>