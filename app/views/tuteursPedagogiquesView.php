<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord Pédagogique</title>
    <link rel="stylesheet" href="../CSS/listEtudiant_pedagogique.css">
</head>
<body>

<h1>Liste des Étudiants</h1>

<?php foreach ($etudiants as $info): ?>
    <div class="listEtudiant" id="etudiant-<?= htmlspecialchars($info['id']) ?>" 
        onclick="loadDocumentEtudiant(<?= htmlspecialchars($info['id']) ?>, '<?= htmlspecialchars($info['nom']) ?>', '<?= htmlspecialchars($info['prenom']) ?>')">

        <p><?= strtoupper(htmlspecialchars($info['nom'])) . ' ' . htmlspecialchars($info['prenom']) ?></p>
        <p>BUT <?= htmlspecialchars($info['Libelle']) ?></p>

        <p>État bordereau : 
            <span class="<?= $info['BordereauEtat'] === 'En attente' ? 'etat-gris' : 'etat-vert' ?>">
                <?= htmlspecialchars($info['BordereauEtat']) ?>
            </span>
        </p>

        <p>État convention : 
            <span class="<?= $info['ConventionEtat'] === 'En attente' ? 'etat-gris' : 'etat-vert' ?>">
                <?= htmlspecialchars($info['ConventionEtat']) ?>
            </span>
        </p>
    </div>
<?php endforeach; ?>

<script src="../JS/script_pedagogique.js"></script>
</body>
</html>
