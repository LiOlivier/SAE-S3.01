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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        #one {
            text-align: center;
            margin: 2rem 0;
        }

        #etudiants {
            margin: 0 auto;
            padding: 2rem 1rem;
            max-width: 800px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #etudiants h2 {
            margin-bottom: 1rem;
            text-align: left;
            color: #333;
        }

        .container {
            display: flex;
            flex-direction: column;
            gap: 1.5rem; /* Espacement entre les cartes */
        }

        .card {
            width: 100%;
            padding: 1.5rem;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .nom {
            margin: 0;
            font-size: 1.2rem;
            font-weight: bold;
            color: #444;
        }

        .tooltip {
            margin-top: 0.5rem;
            font-size: 0.9rem;
            color: #666;
        }

        .tooltip span {
            display: block;
            margin-bottom: 0.3rem;
        }
    </style>
</head>

<?php require_once(__DIR__ . "//component/header.php");
require_once(__DIR__ . "//component/aside.php");
?>

<body>
    <section id="one">
        <h1 id="titre">BUT Informatique</h1>
        <?php require "component/notification.php" ?>
    </section>

    <?php
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=localhost;dbname=sae3.01;charset=utf8', 'root', '');

    // Requête pour obtenir les étudiants en BUT2
    $sql = "SELECT utilisateur.nom, utilisateur.prenom, utilisateur.email, etudiant.id_Etudiant
            FROM utilisateur
            JOIN etudiant ON utilisateur.id = etudiant.Id
            JOIN inscription ON etudiant.Id = inscription.Id_Etudiant
            WHERE inscription.numSemestre = 6";

    $stmt = $pdo->query($sql);
    $etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <section id="etudiants">
        <h2>Étudiants en BUT2</h2>
        <div class="container">
            <?php foreach ($etudiants as $etudiant): ?>
                <div class="card">
                    <h3 class="nom"><?= htmlspecialchars($etudiant['nom']) ?> <?= htmlspecialchars($etudiant['prenom']) ?></h3>
                    <div class="tooltip">
                        <span>Email : <?= htmlspecialchars($etudiant['email']) ?></span>
                        <span>Numéro étudiant : <?= htmlspecialchars($etudiant['id_Etudiant']) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <script src="../JS/notif.js"></script>
</body>

</html>
