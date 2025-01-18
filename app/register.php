<?php 
require "controller/registerController.php";
?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/register.css">
</head>

<body>
    <section class="haut_de_page">
        <div class="background"></div>
        <div class="logo">
            <img src="../IMG/USPN.png" alt="Logo USPN">
        </div>
        <nav class="haut">
            <ul class="navbar">
                <li>
                    <img src="../IMG/icones/planète.png" alt="Planète" class="icon"> Français
                    <img src="../IMG/icones/flèche.png" alt="Flèche" class="arrow" id="arrow">
                </li>
                <li id="english">
                    <img src="../IMG/icones/planète.png" alt="Planète" class="icon"> English
                </li>
            </ul>
        </nav>
        <div class="title">
            <h1>Register</h1>
            <form action="register.php" method="post">
                <div class="champ-input">
                    <label for="identifiant">Nom</label>
                    <div class="input-wrapper">
                        <img src="../IMG/icones/profile.png" alt="Icône Utilisateur" class="input-icon">
                        <input type="text" name="nom" id="nom" placeholder="Votre nom">
                    </div>
                    <label for="identifiant">Prenom</label>
                    <div class="input-wrapper">
                        <img src="../IMG/icones/profile.png" alt="Icône Utilisateur" class="input-icon">
                        <input type="text" name="prenom" id="prenom" placeholder="Votre prenom">
                    </div>
                    <label for="identifiant">Email</label>
                    <div class="input-wrapper">
                        <img src="../IMG/icones/profile.png" alt="Icône Utilisateur" class="input-icon">
                        <input type="text" name="email" id="email" placeholder="Votre email">
                    </div>
                    <label for="identifiant">Tel</label>
                    <div class="input-wrapper">
                        <img src="../IMG/icones/profile.png" alt="Icône Utilisateur" class="input-icon">
                        <input type="text" name="tel" id="tel" placeholder="Votre tel">
                    </div>
                    <label for="identifiant">Identifiant</label>
                    <div class="input-wrapper">
                        <img src="../IMG/icones/profile.png" alt="Icône Utilisateur" class="input-icon">
                        <input type="text" name="identifiant" id="identifiant" placeholder="Votre identifiant">
                    </div>

                    <label for="motdepasse">Mot de passe</label>
                    <div class="input-wrapper">
                        <img src="../IMG/icones/Lock.jpg" alt="Icône Verrou" class="input-icon">
                        <input type="password" name="password" id="password" placeholder="Votre mot de passe">
                    </div>
                </div>
                <input type="submit" value="Create" name="connexion" class="but_login" style="bottom: 47px;"></input>

            </form>
        </div>
    </section>
</body>

</html>