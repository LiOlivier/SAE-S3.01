<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - Responsable de Stage</title>
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
        <h1 id="titre">Notifications</h1>
        <div class="cards">
            <ul>
            <li>Huy n'a pas encore soumis son Bordereau.</li>
            <li>La date de soutenance de Denis n'est pas encore fixée.</li>
            </ul>
        </div>
        <?php require "component/notification.php" ?>
    </section>
</body>

</html>
<script src="../JS/notif.js"></script>