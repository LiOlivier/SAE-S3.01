<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Etudiants - Responsable de Stage</title>
    <link rel="stylesheet" href="../CSS/aside.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/secretaire.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
        integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
</head>

<body class="body">
    <?php 
        require_once(__DIR__ . "/../component/header.php");
        require_once(__DIR__ . "/../component/aside.php"); 
    ?>

    <section id="one">
        <h1 id="titre">Liste des Etudiants</h1>
        <div class="cards">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($etudiants)) { ?>
                            <tr><td colspan="4">Aucun étudiant trouvé.</td></tr>
                        <?php } else { 
                            foreach ($etudiants as $etudiant) { ?>
                                <tr class="clickable-row" data-id="<?php echo htmlspecialchars($etudiant['id_etudiant'], ENT_QUOTES); ?>">
                                    <td><?php echo htmlspecialchars($etudiant['nom'], ENT_QUOTES); ?></td>
                                    <td><?php echo htmlspecialchars($etudiant['prenom'], ENT_QUOTES); ?></td>
                                    <td><?php echo htmlspecialchars($etudiant['email'], ENT_QUOTES); ?></td>
                                    <td><?php echo htmlspecialchars($etudiant['telephone'], ENT_QUOTES); ?></td>
                                </tr>
                            <?php } 
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var rows = document.querySelectorAll('.clickable-row');
            rows.forEach(function(row) {
                row.addEventListener('click', function() {
                    var studentId = this.getAttribute('data-id');
                    window.location.href = 'secretaire-student-details.php?id=' + studentId;
                });
            });
        });
    </script>
</body>
</html>