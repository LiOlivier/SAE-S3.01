<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Depôt des documents</title>
    <link rel="stylesheet" href="../CSS/aside.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/card.css">
    <link rel="stylesheet" href="../CSS/depot.css">




</head>
<?php require_once(__DIR__ . "/header.php");
require_once(__DIR__ . "/aside.php"); ?>

<body class="body">
    <section id="one">

        <h1 id="titre">Document a déposer</h1>
        <div class="cards">
            <h1>Contact : </h1>
            <div class="card ">
                <div class="container">
                    <div class="left">
                        <div style="display: block;">
                            <h3 class="nom depot-nom">Bordereau de stage</h3>
                            <h4 class="date-limite"> Date limite : 12/01/2025</h4>

                            <button id="contacter" class="copier-email">contact</button>
                            <input type="hidden" value="email1@exemple.com">
                            <div id="notification-container" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>

</body>

</html>