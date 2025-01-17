<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'étudiant - Responsable de Stage</title>
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
        <section id="student-info">
            <h2>Informations sur l'étudiant</h2>
            <p><strong>Nom :</strong> Sherwin</p>
            <p><strong>Email :</strong> Sherwin@example.com</p>
            <p><strong>Année de stage :</strong> Semestre 4</p>
        </section>

        <section id="stage-history">
            <h2>Historique des stages</h2>
            <table>
                <thead>
                    <tr>
                        <th>Stage</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Semestre 4</td>
                        <td>2025-01-10</td>
                        <td>2025-03-15</td>
                        <td>En cours</td>
                        <td><a href="#">Voir les documents</a></td>
                    </tr>
                    <tr>
                        <td>Semestre 6</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><a href="#">Voir les documents</a></td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section id="documents">
            <h2>Répertoire de documents</h2>
            <ul>
                <li><a href="#">Rapport de stage - Semestre 4</a></li>
                <li><a href="#">Rapport de stage - Semestre 6</a></li>
            </ul>
        </section>

        <section id="communication">
            <h2>Communication</h2>
            <form>
                <label for="message">Envoyer un message :</label><br>
                <textarea id="message" rows="4" cols="50" placeholder="Écrivez votre message ici..."></textarea><br>
                <button type="submit">Envoyer</button>
            </form>
        </section>
    </main>

    </section>
</body>
</html>
