<?php
require_once(__DIR__ . '/../models/SecretaireStageModel.php');
require_once(__DIR__ . '/../dbdata.php');

class StageController {
    private $model;

    public function __construct() {
        $this->model = new StageModel();
    }

    public function displayStages() {
        $stages = $this->model->getAllStages();
        require(__DIR__ . '/../views/secretaireStagesView.php');
    }
}
?>