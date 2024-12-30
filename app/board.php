<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="../CSS/TBD.css">
    <link rel="stylesheet" href="../CSS/aside.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/card.css">


    

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
        integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <script src="TBD_eleve.html"></script>
</head>
<?php require_once(__DIR__ . "/header.php");
require_once(__DIR__ . "/aside.php");

?>
<style>

</style>

<body class="body">
    <section id="one">


        <h1 id="titre">Tableau de Bord</h1>

        <div class="container">


            <div class="left-tableau">
                <div style="display: block;">
                    <div class="cards">
                        <h1>Contact : </h1>
                        <div class="card">
                            <div class="container">
                                <div class="left">
                                    <div style="display: block;">
                                        <h3 class="nom">tuteur pédagogique</h3>

                                        <button id="contacter" class="copier-email">contact</button>
                                        <input type="hidden" value="email1@exemple.com">
                                        <div id="notification-container" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card">
                            <div class="container">
                                <div class="left">
                                    <div style="display: block;">
                                        <h3 class="nom">tuteur Entreprise</h3>
                                        <button id="contacter" class="copier-email">contact</button>
                                        <input type="hidden" value="tuteur@gmail.com">
                                        <p id="message" style="color: green; font-size: 14px; display: none;">Email copié dans le presse-papier !</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="container">
                                <div class="left">
                                    <div style="display: block;">
                                        <h3 class="nom">tuteur Entreprise</h3>
                                        <button id="contacter" class="copier-email">contact</button>
                                        <input type="hidden" value="tutdeeee@gmail.com">
                                        <p id="message" style="color: green; font-size: 14px; display: none;">Email copié dans le presse-papier !</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="cards">
                        <h1>A venir :</h1>
                        <div class="card">
                            <div class="container">
                                <div class="left">
                                    <div style="display: block;">
                                        <h3 class="nom">Rapport de stage</h3>
                                        <h3 class="date-limite">date limite 29/01</h3>
                                        <button id="ouvrir">ouvrir</button>
                                        <input type="hidden" value="id">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="container">
                                <div class="left">
                                    <div style="display: block;">
                                        <h3 class="nom">Convention de stage</h3>
                                        <h3 class="date-limite">date limite 29/01</h3>
                                        <button id="ouvrir">ouvrir</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="right-tableau">

                <!-- Interface tuteur pedagogique -->
                <div class="card taches">
                    <div class="container">
                        <div style="display: block;">
                            <h3 class="nom">Document a deposer</h3>
                            <button class="tache">bordereau de stage <i class="fas fa-chevron-right fa-sm" style="color: #c0c0c0; position: relative; left:1em;"></i></button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        </div>
    </section>
</body>

</html>
<script src="../JS/notif.js"></script>
<script>
    // script pour redireger vers la page de depot de document
    document.querySelectorAll('.tache').forEach(button => {
        button.addEventListener('click', function() {
            window.location.href = "depot.php";
        });
    });


    document.querySelectorAll('.copier-email').forEach(button => {
        button.addEventListener('click', function() {
            const hiddenInput = button.nextElementSibling;

            if (hiddenInput && hiddenInput.type === "hidden") {
                const email = hiddenInput.value;
                navigator.clipboard.writeText(email).then(() => {
                    showNotification('Email copié dans le presse-papier !');
                }).catch(err => {
                    console.error('Erreur lors de la copie : ', err);
                });
            }
        });
    });
</script>