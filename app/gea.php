<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUT Informatique</title>
    <link rel="stylesheet" href="../CSS/aside.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/card.css">
    <link rel="stylesheet" href="../CSS/TBD.css">
    <link rel="stylesheet" href="../CSS/t.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
        integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
</head>

<?php 
require_once('./controller/sessionController.php');
require_once(__DIR__ . "//component/header.php");
require_once(__DIR__ . "//component/aside.php");
?>

<body class="body">
    <section id="one">
        <h1 id="titre">BUT GEA</h1>

        <div class="container">
            <div class="main-cards">
                <!-- Case 1: BUT 2 -->
                <div class="card clickable-card" onclick="navigateTo('but4g.php')">
                        <h3 class="nom">BUT 2</h3>
                        <p class="details">128 étudiants</p>
                </div>

                <!-- Case 2: BUT 3 -->
                <div class="card clickable-card" onclick="navigateTo('but6g.php')">
                        <h3 class="nom">BUT 3</h3>
                        <p class="details">90 étudiants</p>
                </div>
            </div>
        </div>
        <?php require "component/notification.php" ?>
    </section>

    <script src="../JS/notif.js"></script>
    <script>
        // Redirection vers une autre page en fonction de la case cliquée
        function navigateTo(page) {
            window.location.href = page;
        }
    </script>
</body>

</html>
