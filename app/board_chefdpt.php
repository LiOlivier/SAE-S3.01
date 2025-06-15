<<<<<<< HEAD
=======
<?php



    require('./controller/sessionController.php');
    require_once(__DIR__ ."/component/header.php");
    require_once(__DIR__ ."/component/aside.php") ;
    require_once(__DIR__ ."/component/section.php") ;
?>

>>>>>>> origin/main
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
        integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/navHaut.css">
    <link rel="stylesheet" href="../CSS/aside.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/section.css">
    <link rel="stylesheet" href="../CSS/TBD.css">
    
    <title>Tableau de Bord</title>
</head>
<body>

<?php

    require('./controller/sessionController.php');
    require_once(__DIR__ ."/component/header.php");
    require_once(__DIR__ ."/component/aside.php") ;
    require (__DIR__."/models/ChefDptModel.php");

    $model = Model::getModel();

    $dpt = $model->getDpt($_SESSION["user"]["id"]);
    $nb_etudiants_but2 = $model->getNbEtudiants(4, $dpt);
    $nb_etudiants_but3 = $model->getNbEtudiants(6, $dpt);
?>

<section id="body-tdb">

        <div id="main-content">
            <article id="article-tdb">
                <h1 id="titre-formation">Formation</h1>
                <div class="bloc-formation" data-file="listEtudiantS4">
                    <p id="titre-but">But 2 Informatique</p>
                    <p><?=$nb_etudiants_but2?> étudiants</p>
                </div>
                <div class="bloc-formation" data-file="listEtudiantS6">
                    <p id="titre-but">But 3 Informatique</p>
                    <p><?=$nb_etudiants_but3?> étudiants</p>
                </div>
            </article>
        </div>
</section>

<script src="../JS/chefdpt.js"></script>
</body>
</html>
