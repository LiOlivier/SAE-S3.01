<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapports - Responsable de Stage</title>
    <link rel="stylesheet" href="../CSS/aside.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/card.css">
    <link rel="stylesheet" href="../CSS/TBD.css">
    <link rel="stylesheet" href="../CSS/tableau.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
        integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
</head>
<?php require_once(__DIR__ . "//component/header.php");
require_once(__DIR__ . "//component/aside.php"); ?>

<body class="body">
    <section id="one">
        <h1 id="titre">Rapports</h1>
        <div class="cards">
            <h2>Générer des statistiques de stage</h2>
            <button>Générer des statistiques de stage</button>
        </div>
            <h2>Télécharger un nouveau rapport</h2>
            <form action="upload_report.php" method="post" enctype="multipart/form-data">
                <label for="studentName">Nom de l'étudiant :</label>
                <input type="text" id="studentName" name="studentName" required>
                <label for="company">Entreprise :</label>
                <input type="text" id="company" name="company" required>
                <label for="reportTitle">Titre du rapport :</label>
                <input type="text" id="reportTitle" name="reportTitle" required>
                <label for="reportFile">Télécharger le rapport :</label>
                <button type="submit">Télécharger</button>
            </form>
        </div>
        <?php require "component/notification.php" ?>
    </section>
</body>

</html>
<script src="../JS/notif.js"></script>