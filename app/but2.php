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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
        integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <style>
        .clickable-card {
            text-align: center;
            padding: 20px;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .clickable-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .clickable-card .nom {
            font-size: 18px;
            font-weight: bold;
        }

        .clickable-card .details {
            font-size: 16px;
            color: #666;
            margin-top: 10px;
        }
    </style>
</head>

<?php require_once(__DIR__ . "//component/header.php");
require_once(__DIR__ . "//component/aside.php");
?>

<body class="body">
    <section id="one">
        <h1 id="titre">BUT Informatique</h1>

        <div class="container">
            <div class="main-cards">
                <!-- Exemple de fiche étudiant -->
                <div class="card clickable-card">
                    <div class="container">
                        <h3 class="nom">Jean Dupont</h3>
                        <p class="details">jean.dupont@example.com</p>
                    </div>
                </div>

                <div class="card clickable-card">
                    <div class="container">
                        <h3 class="nom">Marie Curie</h3>
                        <p class="details">marie.curie@example.com</p>
                    </div>
                </div>

                <div class="card clickable-card">
                    <div class="container">
                        <h3 class="nom">Albert Einstein</h3>
                        <p class="details">albert.einstein@example.com</p>
                    </div>
                </div>
            </div>
        </div>
        <?php require "component/notification.php" ?>
    </section>

    <script src="../JS/notif.js"></script>
</body>

</html>
