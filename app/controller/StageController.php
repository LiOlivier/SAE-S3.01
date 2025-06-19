<?php
require_once(__DIR__ . '/../models/StageModel.php');
require_once(__DIR__ . '/../dbdata.php');

class StageController {
    private $model;

    public function __construct() {
<<<<<<< HEAD
        $this->model = new StageModel();
=======
        global $dsn, $login, $mdp;
        $this->model = new StageModel($dsn, $login, $mdp);
>>>>>>> 145365576bb88050561c7ed14ad2574d84df58c3
    }

    public function displayStages() {
        $stages = $this->model->getAllStages();
        require(__DIR__ . '/../views/stagesView.php');
    }
}
?>