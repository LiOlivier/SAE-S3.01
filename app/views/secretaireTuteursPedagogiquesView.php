<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Tuteurs Pédagogiques - Responsable de Stage</title>
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
        <h1 id="titre">Liste des Tuteurs Pédagogiques</h1>
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
                        <?php if (empty($tuteursPedagogiques)) { ?>
                            <tr><td colspan="4">Aucun tuteur pédagogique trouvé.</td></tr>
                        <?php } else { 
                            foreach ($tuteursPedagogiques as $tuteur) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($tuteur['nom'], ENT_QUOTES); ?></td>
                                    <td><?php echo htmlspecialchars($tuteur['prenom'], ENT_QUOTES); ?></td>
                                    <td><?php echo htmlspecialchars($tuteur['email'], ENT_QUOTES); ?></td>
                                    <td><?php echo htmlspecialchars($tuteur['telephone'], ENT_QUOTES); ?></td>
                                </tr>
                            <?php } 
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>
</html>