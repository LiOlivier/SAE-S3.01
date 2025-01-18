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
        .container {
            display: flex;
            flex-direction: column;
            gap: 1rem; /* Espacement entre les cartes */
            align-items: flex-start; /* Aligne les cartes à gauche */
        }

        .card {
            width: 100%; /* Prend toute la largeur disponible */
            max-width: 500px; /* Limite la largeur des cartes */
            padding: 1rem;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .clickable-card {
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .clickable-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .clickable-card .tooltip {
            display: none;
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 8px;
            border-radius: 4px;
            white-space: nowrap;
            font-size: 0.9em;
            z-index: 1000;
        }

        .clickable-card:hover .tooltip {
            display: block;
        }
    </style>
</head>

<?php require_once(__DIR__ . "//component/header.php");
require_once(__DIR__ . "//component/aside.php");
?>

<body class="body">
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
            WHERE inscription.numSemestre = 4";

    $stmt = $pdo->query($sql);
    $etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <section id="etudiants">
        <h2>Étudiants en BUT2</h2>
        <div class="container">
            <?php foreach ($etudiants as $etudiant): ?>
                <div class="card clickable-card">
                    <div class="container">
                        <h3 class="nom"><?= htmlspecialchars($etudiant['nom']) ?> <?= htmlspecialchars($etudiant['prenom']) ?></h3>
                        <div class="tooltip">
                            Email : <?= htmlspecialchars($etudiant['email']) ?><br>
                            Numéro étudiant : <?= htmlspecialchars($etudiant['id_Etudiant']) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <script src="../JS/notif.js"></script>
</body>

</html>
