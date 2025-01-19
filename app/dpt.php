<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="../CSS/aside.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/card.css">
    <link rel="stylesheet" href="../CSS/TBD.css">
    <link rel="stylesheet" href="../CSS/t.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
        integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <style>
        .clickable-card .nom:hover {
            font-weight: bold;
        }
    </style>
</head>

<?php require_once(__DIR__ . "//component/header.php");
require_once(__DIR__ . "//component/aside.php");
?>

<body class="body">
    <section id="one">
        <h1 id="titre">Tableau de Bord</h1>

        <div class="container">
            <!-- Boîtes principales -->
            <div class="main-cards">
                <!-- Case 1: BUT Informatique -->
                <div class="card clickable-card" onclick="navigateTo('informatique.php')">
                    <div class="container">
                        <h3 class="nom">BUT Informatique</h3>
                    </div>
                </div>

                <!-- Case 2: BUT GEA -->
                <div class="card clickable-card" onclick="navigateTo('gea.php')">
                    <div class="container">
                        <h3 class="nom">BUT GEA</h3>
                    </div>
                </div>

                <!-- Case 3: BUT RT -->
                <div class="card clickable-card" onclick="navigateTo('rt.php')">
                    <div class="container">
                        <h3 class="nom">BUT RT</h3>
                    </div>
                </div>

                <!-- Case 4: BUT SD -->
                <div class="card clickable-card" onclick="navigateTo('sd.php')">
                    <div class="container">
                        <h3 class="nom">BUT SD</h3>
                    </div>
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
        