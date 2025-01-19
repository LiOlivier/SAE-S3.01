<?php 
require_once('./controller/sessionController.php');
require_once(__DIR__ . "//component/header.php");
require_once(__DIR__ . "//component/aside.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="../CSS/aside.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/card_entreprise.css">
    <link rel="stylesheet" href="../CSS/TBD_entreprise.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
        integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <script src="TBD_directeur_etude.html"></script>
</head>

<style>

</style>

<body class="body">
    <section id="one">


        <h1>Tableau de Bord</h1>

        <div class="container">


            <div class="left-tableau">
                <div style="display: block;">
                    <div class="cards">
                        <h2>Formations </h2>

                        <div class="card contacter">
                            <div class="container">
                                <div class="left">
                                    <div style="display: block;">
                                        <h3 class="nom">BUT2 Informatique</h3>
                                        <p class="classe">75 etudiants</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card contacter">
                            <div class="container">
                                <div class="left">
                                    <div style="display: block;">
                                        <h3 class="nom">BUT3 Informatique</h3>
                                        <p class="classe">78 etudiants</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>
                </div>
            </div>
        </div>
        <?php require "component/notification.php" ?>
    </section>
</body>

</html>
<script src="../JS/notif.js"></script>
<script>    
        document.querySelectorAll('.card').forEach(button => {
        button.addEventListener('click', function() {
            window.location.href = "board_chefdpt_liste.php";
        });
    });
</script>
<script>
    // script pour redireger vers la page de depot de document
    document.querySelectorAll('.tache').forEach(button => {
        button.addEventListener('click', function() {
            window.location.href = "depot.php";
        });
    });
    document.querySelectorAll('#ouvrir').forEach(button => {
        button.addEventListener('click', function() {
            window.location.href = "depot.php";
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