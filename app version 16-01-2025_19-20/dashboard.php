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


<?php require_once(__DIR__ . "//component/header.php");
require_once(__DIR__ . "//component/aside.php"); ?>


<body class="body">
    <section id="one">

    <main>
        <section id="overview">
            <h2>Tableau de Bord</h2>
            <p>Résumé rapide des actions en attente et des mises à jour récentes.</p>
            <ul>
                <li>5 étudiants ont des rapports en retard.</li>
                <li>3 soutenances sont prévues pour cette semaine.</li>
            </ul>
        </section>

        <section id="student-table">
            <h2>Vue d'ensemble des étudiants</h2>
            <table>
                <thead>
                    <tr>
                        <th>Étudiant</th>
                        <th>Année de stage</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Yassine</td>
                        <td>Semestre 4</td>
                        <td>2025-01-10</td>
                        <td>2025-03-15</td>
                        <td>En cours</td>
                        <td><a href="student-details.html">Voir les détails</a></td>
                    </tr>
                    <tr>
                        <td>Huy</td>
                        <td>Semestre 6</td>
                        <td>2025-01-10</td>
                        <td>2025-06-20</td>
                        <td>Terminé</td>
                        <td><a href="student-details.html">Voir les détails</a></td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section id="notifications">
            <h2>Notifications récentes</h2>
            <ul>
                <li>Yassine : Rapport en retard.</li>
                <li>Huy : Soutenance prévue pour le 2025-06-15.</li>
            </ul>
        </section>
    </main>

    
    </section>
</body>
</html>
