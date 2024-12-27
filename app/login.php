<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
    <link rel="stylesheet" href="../CSS/style.css">
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
            <h1>Connexion</h1>
            <form action="#">
                <div class="champ-input">
                    <label for="identifiant">Identifiant</label>
                    <div class="input-wrapper">
                        <img src="../IMG/icones/profile.png" alt="Icône Utilisateur" class="input-icon">
                        <input type="text" id="identifiant" placeholder="Votre identifiant">
                    </div>
                </div>
                <div class="champ-input">
                    <label for="motdepasse">Mot de passe</label>
                    <div class="input-wrapper">
                        <img src="../IMG/icones/Lock.jpg" alt="Icône Verrou" class="input-icon">
                        <input type="password" id="motdepasse" placeholder="Votre mot de passe">
                    </div>
                </div>
                <a href="#" class="mdp_oublie">Mot de passe oublié</a>
                <button type="submit" class="but_login">> Me connecter</button>
            </form>
        </div>
    </section>
</body>
</html>
