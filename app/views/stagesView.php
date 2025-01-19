<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Stages - Responsable de Stage</title>
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
        <h1 id="titre">Liste des stages</h1>
        <div class="cards">
            <table>
                <thead>
                    <tr>
                        <th>Année</th>
                        <th>Id Département</th>
                        <th>Semestre</th>
                        <th>Numero étudiant</th>
                        <th>Id Stage</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Mission</th>
                        <th>Date de soutenance</th>
                        <th>Salle de soutenance</th>
                        <th>Id Enseignant 1</th>
                        <th>Id Tuteur Entreprise</th>
                        <th>Id Enseignant 2</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($stages)) { ?>
                        <tr><td colspan="13">Aucun stage trouvé.</td></tr>
                    <?php } else { 
                        foreach ($stages as $stage) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($stage['annee'], ENT_QUOTES); ?></td>
                                <td><?php echo htmlspecialchars($stage['Id_Departement'], ENT_QUOTES); ?></td>
                                <td><?php echo htmlspecialchars($stage['numSemestre'], ENT_QUOTES); ?></td>
                                <td><?php echo htmlspecialchars($stage['Id_Etudiant'], ENT_QUOTES); ?></td>
                                <td><?php echo htmlspecialchars($stage['Id_Stage'], ENT_QUOTES); ?></td>
                                <td><?php echo htmlspecialchars($stage['date_debut'], ENT_QUOTES); ?></td>
                                <td><?php echo htmlspecialchars($stage['date_fin'], ENT_QUOTES); ?></td>
                                <td><?php echo htmlspecialchars($stage['mission'], ENT_QUOTES); ?></td>
                                <td><?php echo htmlspecialchars($stage['date_soutenance'], ENT_QUOTES); ?></td>
                                <td><?php echo htmlspecialchars($stage['salle_soutenance'], ENT_QUOTES); ?></td>
                                <td><?php echo htmlspecialchars($stage['Id_Enseignant_1'], ENT_QUOTES); ?></td>
                                <td><?php echo htmlspecialchars($stage['Id_Tuteur_Entreprise'], ENT_QUOTES); ?></td>
                                <td><?php echo htmlspecialchars($stage['Id_Enseignant_2'], ENT_QUOTES); ?></td>
                            </tr>
                        <?php } 
                    } ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>