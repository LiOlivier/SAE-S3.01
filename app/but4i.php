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
            margin: 20px auto; /* Ajoute des marges verticales */
            padding: 20px; /* Ajoute des marges internes */
            max-width: 800px; /* Limite la largeur pour une meilleure lisibilité */
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
            flex-direction: column; /* Les cartes restent en colonne */
            gap: 20px; /* Espacement uniforme entre les cartes */
            padding: 10px; /* Ajout d'une marge interne */
        }

        .card {
            display: flex;
            flex-direction: column; /* Réorganise les éléments en colonne */
            align-items: flex-start; /* Aligne les éléments à gauche */
            padding: 1.5rem;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 20px; /* Espace entre les cartes */
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

/* Container pour le titre (nom et point rouge/vert) */
        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            margin-bottom: 10px; /* Ajoute un espace sous le titre */
        }

        .nom {
            font-size: 1.2rem;
            font-weight: bold;
            color: #444;
            margin: 0;
        }

/* Style pour les infos comme email et téléphone */
        .card-info {
            font-size: 0.9rem;
            color: #666;
            margin-top: 5px; /* Ajoute un léger espace entre les lignes */
            line-height: 1.6; /* Augmente l'espacement entre les lignes */
        }

/* Point rouge ou vert */
        .status {
            width: 12px;
            height: 12px;
            display: inline-block;
            border-radius: 50%;
            margin-left: 10px;
        }

        .status.vert {
            background-color: green;
        }

        .status.rouge {
            background-color: red;
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

    // Requête pour obtenir les étudiants en INFO semestre 4 avec statut
    $sql = "SELECT utilisateur.nom, utilisateur.prenom, utilisateur.email, utilisateur.telephone, etudiant.id_Etudiant,
                   CASE
                       WHEN stage.Id_Stage IS NOT NULL OR action.Id_Action IS NOT NULL THEN 'vert'
                       ELSE 'rouge'
                   END AS statut,
                   stage.mission, stage.date_debut, stage.date_fin, stage.salle_soutenance
            FROM utilisateur
            JOIN etudiant ON utilisateur.id = etudiant.Id
            JOIN inscription ON etudiant.Id = inscription.Id_Etudiant
            LEFT JOIN stage ON inscription.Id_Etudiant = stage.Id_Etudiant AND inscription.numSemestre = stage.numSemestre
            LEFT JOIN action ON inscription.Id_Etudiant = action.Id_Etudiant AND inscription.numSemestre = action.numSemestre
            WHERE inscription.numSemestre = 4 AND inscription.Id_Departement = 1";

    $stmt = $pdo->query($sql);
    $etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <section id="etudiants">
        <h2>Étudiants en INFO Semestre 4</h2>
        <div class="container">
            <?php foreach ($etudiants as $etudiant): ?>
                <div class="card">
                    <h3 class="nom">
                        <?= htmlspecialchars($etudiant['nom']) ?> <?= htmlspecialchars($etudiant['prenom']) ?>
                        <span class="status <?= htmlspecialchars($etudiant['statut']) ?>"
                              data-mission="<?= htmlspecialchars($etudiant['mission']) ?>"
                              data-debut="<?= htmlspecialchars($etudiant['date_debut']) ?>"
                              data-fin="<?= htmlspecialchars($etudiant['date_fin']) ?>"
                              data-soutenance="<?= htmlspecialchars($etudiant['salle_soutenance']) ?>">
                        </span>
                    </h3>
                    <div class="tooltip">
                        <span>Email : <?= htmlspecialchars($etudiant['email']) ?></span>
                        <span>Numéro de téléphone : <?= htmlspecialchars($etudiant['telephone']) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const statusElements = document.querySelectorAll('.status');

            statusElements.forEach(element => {
                element.addEventListener('click', () => {
                    const mission = element.getAttribute('data-mission') || 'Aucune mission';
                    const debut = element.getAttribute('data-debut') || 'Non défini';
                    const fin = element.getAttribute('data-fin') || 'Non défini';
                    const soutenance = element.getAttribute('data-soutenance') || 'Non défini';

                    alert(`
                        Mission : ${mission}
                        Date de début : ${debut}
                        Date de fin : ${fin}
                        Salle de soutenance : ${soutenance}
                    `);
                });
            });
        });
    </script>
</body>

</html>
