<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUT RT</title>
    <link rel="stylesheet" href="../CSS/aside.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/card.css">
    <link rel="stylesheet" href="../CSS/TBD.css">
    <link rel="stylesheet" href="../CSS/t.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
        integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/adminPage.css">
</head>

<?php require_once('./controller/sessionController.php');
require_once(__DIR__ . "//component/header.php");
require_once(__DIR__ . "//component/aside.php");
?>

<body>
    <section id="one">
        <h1 id="titre">BUT GEA</h1>
        <?php require "component/notification.php" ?>
    </section>

    <?php
    // Connexion à la base de données
    require_once(__DIR__ . '/../config/database.php');
    $pdo = Database::getConnexion('mysql');

    // Requête pour obtenir les étudiants en RT semestre 4 avec statut
    $sql = "SELECT utilisateur.nom, utilisateur.prenom, utilisateur.email, utilisateur.telephone, etudiant.id_Etudiant,
                   CASE
                       WHEN stage.Id_Stage IS NOT NULL OR action.Id_Action IS NOT NULL THEN 'vert'
                       ELSE 'rouge'
                   END AS statut,
                   stage.mission, stage.date_debut, stage.date_fin, stage.salle_soutenance
            FROM utilisateur
            JOIN etudiant ON utilisateur.id = etudiant.Id_etudiant
            JOIN inscription ON etudiant.Id_etudiant = inscription.Id_Etudiant
            LEFT JOIN stage ON inscription.Id_Etudiant = stage.Id_Etudiant AND inscription.num_Semestre = stage.num_Semestre
            LEFT JOIN action ON inscription.Id_Etudiant = action.Id_Etudiant AND inscription.num_Semestre = action.num_Semestre
            WHERE inscription.num_Semestre = 4 AND inscription.Id_Departement = 3";

    $stmt = $pdo->query($sql);
    $etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <section id="etudiants">
        <h2>Étudiants en RT Semestre 4</h2>
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
