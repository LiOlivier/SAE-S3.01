<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - Responsable de Stage</title>
    <link rel="stylesheet" href="../CSS/aside.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/card.css">
    <link rel="stylesheet" href="../CSS/TBD.css">
    <link rel="stylesheet" href="../CSS/tableau.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
        integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
</head>

<?php require_once(__DIR__ . "/../component/header.php");
require_once(__DIR__ . "/../component/aside.php"); ?>

<body class="body">
    <section id="one">
        <main>
            <section id="quick-summary">
                <h2>Résumé rapide des actions en attente et des mises à jour récentes</h2>
                <ul>
                    <li><?php echo $overdueReportsCount; ?> étudiants ont des rapports en retard.</li>
                    <li><?php echo $upcomingSoutenancesCount; ?> soutenances sont prévues pour cette semaine.</li>
                    <li><?php echo $stagesWithoutJuryCount; ?> stages en cours sans jury assigné.</li>
                    <li><?php echo $totalStudentsCount; ?> étudiants inscrits.</li>
                    <li><?php echo $totalStagesCount; ?> stages en cours.</li>
                </ul>
            </section>

            <section id="recent-notifications">
                <h2>Notifications récentes</h2>
                <ul>
                    <?php foreach ($recentNotifications as $notification) { ?>
                        <li><?php echo htmlspecialchars($notification['prenom']) . ' ' . htmlspecialchars($notification['nom']) . ' a ' . htmlspecialchars($notification['libelle']) . ' le ' . htmlspecialchars($notification['date_realisation']); ?>.</li>
                    <?php } ?>
                </ul>
            </section>
        </main>
    </section>
</body>
</html>