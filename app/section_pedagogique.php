<head><link rel="stylesheet" href="../CSS/section_pedagogique.css"></head>
<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'pedagogique') {
    http_response_code(403);
    exit('Accès refusé');
}

require_once __DIR__ . '/models/TuteurPedagogiqueModel.php';

$model = new TuteurPedagogiqueModel();
$etudiants = $model->getListeEtudiants($_SESSION['user']['id']);
?>

        <h1>Liste des Étudiants</h1>
        <?php foreach ($etudiants as $info): ?>
            <div class="listEtudiant" id="etudiant-<?= htmlspecialchars($info['id']) ?>"
                 onclick="loadDocumentEtudiant(<?= htmlspecialchars($info['id']) ?>, '<?= addslashes(htmlspecialchars($info['nom'])) ?>', '<?= addslashes(htmlspecialchars($info['prenom'])) ?>')">
                <p><?= strtoupper(htmlspecialchars($info['nom'])) . ' ' . htmlspecialchars($info['prenom']) ?></p>
                <p>BUT <?= htmlspecialchars($info['Libelle']) ?></p>
                <?php
                $etatClasseBord = ($info["BordereauEtat"] === "Tâche complète") ? 'etat-vert' : 'etat-gris';
                $etatClasseConv = ($info["ConventionEtat"] === "Tâche complète") ? 'etat-vert' : 'etat-gris';
                ?>
                <p>État bordereau : <span class="<?= $etatClasseBord ?>"><?= htmlspecialchars($info["BordereauEtat"]) ?></span></p>
                <p>État convention : <span class="<?= $etatClasseConv ?>"><?= htmlspecialchars($info["ConventionEtat"]) ?></span></p>
            </div>
        <?php endforeach; ?>