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
                                        <input type="hidden" value="tuteur@gmail.com">
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
                                        <h3 id="date-limite">date limite 29/01</h3>
                                        <button id="ouvrir">ouvrir</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="container">
                                <div class="left">
                                    <div style="display: block;">
                                        <h3 class="nom">Convention de stage</h3>
                                        <h3 id="date-limite">date limite 29/01</h3>
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
                            <div style="display: block;">
                                <h6 style="margin-bottom: 0px;"> Etat</h6>
                                <span style="font-size: 12px; margin-right: auto;"> Tache completé <i class="fas fa-circle" style="color: #63E6BE;"></i></span>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
        </div>
    </section>
</body>

</html>

<script>
    // precces
    document.querySelectorAll('.copier-email').forEach(button => {
        button.addEventListener('click', function() {
            const hiddenInput = button.nextElementSibling;

            if (hiddenInput && hiddenInput.type === "hidden") {
                const email = hiddenInput.value;
                navigator.clipboard.writeText(email).then(() => {
                    const message = hiddenInput.nextElementSibling;
                    if (message) {
                        message.style.display = "block";
                        setTimeout(() => {
                            message.style.display = "none";
                        }, 2000);
                    }
                }).catch(err => {
                    console.error('Erreur lors de la copie : ', err);
                });
            }
        });
    });
</script>