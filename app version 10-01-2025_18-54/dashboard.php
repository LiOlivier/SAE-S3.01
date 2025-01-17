<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - Responsable de Stage</title>
    <link rel="stylesheet" href="../CSS/aside.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/card.css">
    <link rel="stylesheet" href="../CSS/TBD.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
        integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
</head>
<?php require_once(__DIR__ . "//component/header.php");
require_once(__DIR__ . "//component/aside.php"); ?>

<body class="body">
    <section id="one">
        <h1 id="titre">Tableau de Bord</h1>
        <div class="container">
            <div class="left-tableau">
                <div class="cards">
                    <h1>Stages Actifs</h1>
                    <div class="card">
                        <div class="container">
                            <div class="left">
                                <div style="display: block;">
                                    <h3 class="nom">20</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h1>Actions en retard</h1>
                    <div class="card">
                        <div class="container">
                            <div class="left">
                                <div style="display: block;">
                                    <h3 class="nom">5</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h1>Rapports en attente</h1>
                    <div class="card">
                        <div class="container">
                            <div class="left">
                                <div style="display: block;">
                                    <h3 class="nom">8</h3>
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