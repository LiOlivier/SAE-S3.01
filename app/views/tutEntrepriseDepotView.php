<?php
require_once(__DIR__ . "/../models/TuteurEntrepriseModel.php");
require_once(__DIR__ . "/../controller/info_card_entrepriseController.php"); ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="../../CSS/aside.css">
    <link rel="stylesheet" href="../../CSS/header.css">
    <link rel="stylesheet" href="../../CSS/TBD_entreprise.css">
    <link rel="stylesheet" href="../../CSS/card_entreprise.css">
    <link rel="stylesheet" href="../../CSS/notification.css">
    <link rel="stylesheet" href="../../CSS/depot_entreprise.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
        integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
</head>
<?php require_once(__DIR__ . "/../component/header.php");
require_once(__DIR__ . "/../component/aside_entreprise.php");
?>

<body class="body">
    <section id="one">
        <h1 id="titre">Dépot de document</h1>

        <?php foreach ($etudiantsActions as $etudiantId => $etudiant): ?>
            <div class="etudiant-section">
    <h2><?= htmlspecialchars($etudiant['nom'] . ' ' . $etudiant['prenom']) ?></h2>

    <div class="card-container">
        <!-- Bordereau de Stage -->
        <div class="card">
            <div class="container">
                <div class="left">
                    <div style="display: block;">
                        <h3 class="nom depot-nom">Bordereau de Stage</h3>
                        <h4 class="date-limite">Date Limite : <?= htmlspecialchars($etudiant['bordereau']['delai_limite'] ?? 'Non spécifiée') ?></h4>
                        
                        <?php if (!empty($etudiant['bordereau']['etat']) && $etudiant['bordereau']['etat'] === 'Valider' && !empty($etudiant['bordereau']['lien_document'])): ?>
                            <button class="contacter" style="background-color: #00244d; color: #fff; cursor: pointer;" 
                                    onclick="window.location.href='<?= htmlspecialchars($etudiant['bordereau']['lien_document']) ?>'">
                                Télécharger <i class="fas fa-download load" style="color: #fff;"></i>
                            </button>
                        <?php elseif (!empty($etudiant['bordereau']['etat']) && $etudiant['bordereau']['etat'] === 'En attente'): ?>
                            <button class="contacter" style="background-color: #FFA500; color: #fff; cursor: not-allowed;" disabled>
                                En attente de confirmation
                            </button>
                        <?php else: ?>
                            <button class="contacter" style="background-color: #B0B0B0; color: #fff; cursor: not-allowed;" disabled>
                                Non disponible
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Convention de Stage -->
        <div class="card">
            <div class="container">
                <div class="left">
                    <div style="display: block;">
                        <h3 class="nom depot-nom">Convention de Stage</h3>
                        <h4 class="date-limite">Date Limite : <?= htmlspecialchars($etudiant['convention']['delai_limite'] ?? 'Non spécifiée') ?></h4>
                        
                        <?php if (!empty($etudiant['convention']['etat']) && $etudiant['convention']['etat'] === 'Valider' && !empty($etudiant['convention']['lien_document'])): ?>
                            <button class="contacter" style="background-color: #00244d; color: #fff; cursor: pointer;" 
                                    onclick="window.location.href='<?= htmlspecialchars($etudiant['convention']['lien_document']) ?>'">
                                Télécharger <i class="fas fa-download load" style="color: #fff;"></i>
                            </button>
                        <?php elseif (!empty($etudiant['convention']['etat']) && $etudiant['convention']['etat'] === 'En attente'): ?>
                            <button class="contacter" style="background-color: #FFA500; color: #fff; cursor: not-allowed;" disabled>
                                En attente de confirmation
                            </button>
                        <?php else: ?>
                            <button class="contacter" style="background-color: #B0B0B0; color: #fff; cursor: not-allowed;" disabled>
                                Non disponible
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <?php endforeach; ?>
    </section>
</body>

</html>

<script src="../JS/notif.js"></script>
<script>
    // script pour redireger vers la page de depot de document
    document.querySelectorAll('.tache').forEach(button => {
        button.addEventListener('click', function() {
            window.location.href = "depot_entreprise.php";
        });
    });
    document.querySelectorAll('#ouvrir').forEach(button => {
        button.addEventListener('click', function() {
            window.location.href = "depot_entreprise.php";
        });
    });

    document.querySelectorAll('.copier-email').forEach(button => {
        button.addEventListener('click', function() {
            const hiddenInput = button.nextElementSibling;

            if (hiddenInput && hiddenInput.type === "hidden") {
                const email = hiddenInput.value;
                navigator.clipboard.writeText(email).then(() => {
                    showNotification('Email copié dans le presse-papier !');
                }).catch(err => {
                    console.error('Erreur lors de la copie : ', err);
                });
            }
        });
    });
</script>