<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Tuteurs Entreprise - Responsable de Stage</title>
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
        <h1 id="titre">Liste des Tuteurs Entreprise</h1>
        <div class="cards">
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Id Entreprise</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($tuteursEntreprise)) { ?>
                        <tr><td colspan="5">Aucun tuteur entreprise trouvé.</td></tr>
                    <?php } else { 
                        foreach ($tuteursEntreprise as $tuteur) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($tuteur['nom'], ENT_QUOTES); ?></td>
                                <td><?php echo htmlspecialchars($tuteur['prenom'], ENT_QUOTES); ?></td>
                                <td><?php echo htmlspecialchars($tuteur['email'], ENT_QUOTES); ?></td>
                                <td><?php echo htmlspecialchars($tuteur['telephone'], ENT_QUOTES); ?></td>
                                <td><?php echo htmlspecialchars($tuteur['Id_Entreprise'], ENT_QUOTES); ?></td>
                            </tr>
                        <?php } 
                    } ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>