<?php
require_once(__DIR__ . '/../models/SecretaireTuteurPedagogiqueModel.php');
require_once(__DIR__ . '/../dbdata.php');

class TuteurPedagogiqueController {
    private $model;

    public function __construct() {
        $this->model = new TuteurPedagogiqueModel();
    }

    public function displayTuteursPedagogiques() {
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $rowsPerPage = isset($_GET['rows']) && in_array((int)$_GET['rows'], [5, 10, 25, 50]) ? (int)$_GET['rows'] : 10;
        $offset = ($page - 1) * $rowsPerPage;

        // Search
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        // Sort
        $sort = isset($_GET['sort']) && in_array($_GET['sort'], ['nom', 'prenom', 'email', 'telephone']) ? $_GET['sort'] : 'nom';
        $order = isset($_GET['order']) && $_GET['order'] === 'desc' ? 'DESC' : 'ASC';
        // Filter
        $filter = isset($_GET['filter']) && $_GET['filter'] === 'active' ? 'active' : 'all';

        $tutorsPedagogiques = $this->model->getTuteursPedagogiques($offset, $rowsPerPage, $search, $sort, $order, $filter);
        $totalRows = $this->model->getTotalTuteursPedagogiques($search, $filter);
        $totalPages = max(1, ceil($totalRows / $rowsPerPage));

        if (isset($_POST['action']) && $_POST['action'] === 'remove' && isset($_POST['id'])) {
            $id = (int)$_POST['id'];
            if ($this->model->canRemoveTuteurPedagogique($id)) {
                if ($this->model->updateTuteurRole($id, 'tuteur')) {
                    $_SESSION['message'] = ['type' => 'success', 'text' => 'Rôle mis à jour avec succès !'];
                } else {
                    $_SESSION['message'] = ['type' => 'error', 'text' => 'Échec de la mise à jour du rôle.'];
                }
            } else {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Impossible de supprimer : le tuteur est associé à des étudiants.'];
            }
            // Refresh the same page
            $params = http_build_query($_GET);
            header("Location: secretaire-tuteurs-pedagogiques.php?" . $params);
            exit;
        }

        // Clear message after display
        $message = $_SESSION['message'] ?? null;
        unset($_SESSION['message']);

        require(__DIR__ . '/../views/secretaireTuteursPedagogiquesView.php');
    }
}
?>