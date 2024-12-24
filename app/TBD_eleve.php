<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="../CSS/TBD.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
        integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <script src="TBD_eleve.html"></script>
</head>
<?php require_once(__DIR__ . "/header.php");
require_once(__DIR__ . "/aside.php");

?>

<body class="body">
    <section id="one">
        <h1>Liste étudiants</h1>

        <div class="card">
        <div class="container">
                            <div class="left">
                                <div style="display: block;">
                                <h3 class="nom">Maxime Lointier</h3>
                                <h4 class="info">But2 Info </h4>
                                <h4 class="info">Stymphale</h4>
                                <button id="contacter">contacter</button>
                                </div>
                            </div>
                            
                            <div class="right" style="margin-top: 30px;">
                                <div style="display: block;"><h6 style="margin-bottom: 0px;"> Etat</h6>
                                <span style="font-size: 12px; margin-right: auto;"> Tache completé <i class="fas fa-circle" style="color: #63E6BE;"></i></span>
                                </div>
                                
                            </div>
                            
                        </div>


          

        </div>


    </section>
</body>

</html>

<script>
    // redirection vers la page de contact
    document.getElementById("contacter").addEventListener("click", function() {
        window.location.href = "contact.php";
    });
</script>