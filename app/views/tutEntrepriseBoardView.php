<?php
require(__DIR__ . '/../controller/boardController_entreprise.php');
require_once(__DIR__ . '/../models/TuteurEntrepriseModel.php');
?>

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
    

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
        integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <script src="../JS/TBD_eleve.js"></script>
</head>
<?php require_once(__DIR__ . '/../component/header.php');
require_once(__DIR__ . '/../component/aside_entreprise.php');
?>
<style>

</style>

<body class="body">
    <section id="one">
        
        <h1 id="titre">Tableau de bord</h1>
        <h2>Tuteur pédagogique :</h2>
        <?php foreach ($listePedagogiques as $tuteur) : ?>
            <div class="card">
                <div class="container">
                    <div style="display: block;">
                        <h3 class="nom"><?= htmlspecialchars($tuteur['prenom'] . ' ' . $tuteur['nom']) ?></h3>
                        <p class="classe">Tuteur pédagogique</p>
                        <p class="hidden">.</p>
                        <p class="email"><?= htmlspecialchars($tuteur['telephone']) ?></p>
                        <button class="contacter copier-email">copier l'email</button>
                        <input type="hidden" class="email-hidden" value="<?= htmlspecialchars($tuteur['email']) ?>">
                        <div id="notification-container" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        
        <h2>Etudiants :</h2>
        <?php foreach ($listeEtudiants as $etudiant) : ?>
            <div class="card">
                <div class="container">
                    <div style="display: block;">
                        <h3 class="nom"><?= htmlspecialchars($etudiant['prenom'] . ' ' . $etudiant['nom']) ?></h3>
                        <p class="classe">Étudiant</p>
                        <p class="hidden">.</p>
                        <p class="email"><?= htmlspecialchars($etudiant['telephone']) ?></p>
                        <button class="contacter copier-email">copier l'email</button>
                        <input type="hidden" class="email-hidden" value="<?= htmlspecialchars($etudiant['email']) ?>">
                        <div id="notification-container" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php require(__DIR__ . '/../component/notification.php'); ?>
    </section>
</body>

</html>
<script src="../JS/notif.js"></script>
<script>
    // script pour redireger vers la page de depot de document
    document.querySelectorAll('.tache').forEach(button => {
        button.addEventListener('click', function() {
            window.location.href = "../views/depot_entreprise.php";
        });
    });
    document.querySelectorAll('#ouvrir').forEach(button => {
        button.addEventListener('click', function() {
            window.location.href = "../views/depot_entreprise.php";
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