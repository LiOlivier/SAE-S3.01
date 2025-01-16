<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="../CSS/aside.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/card.css">
    <link rel="stylesheet" href="../CSS/TBD.css">
    <link rel="stylesheet" href="../CSS/profil.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
        integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
</head>

<?php require_once(__DIR__ . "//component/header.php");
require_once(__DIR__ . "//component/aside.php"); ?>

<body>
    <section id="one">
        <div class="title-section">
            <h1>Modifier le mot de passe</h1>
        </div>

        <div class="mdp-section">
            <form class="mdp-form">
                <div class="form-group">
                    <label for="new-mdp">Nouveau mot de passe (minimum 8 caractères)</label>
                    <input type="password" id="new-mdp" placeholder="Entrez votre nouveau mot de passe" required>
                    <i class="mdp-gestion">
                        <img src="../IMG/icones/mdp1.png" alt="Masquer le mot de passe" id="toggle-password" class="eye-icon">
                        <img src="../IMG/icones/mdp.png" alt="Afficher le mot de passe" id="toggle-password-show" class="eye-icon" style="display: none;">
                    </i>
                </div>
                <div class="form-group">
                    <label for="confirm-mdp">Confirmation du mot de passe</label>
                    <input type="password" id="confirm-mdp" placeholder="Confirmez votre mot de passe" required>
                    <i class="mdp-gestion">
                        <img src="../IMG/icones/mdp1.png" alt="Masquer le mot de passe" id="toggle-password-confirm" class="eye-icon">
                        <img src="../IMG/icones/mdp.png" alt="Afficher le mot de passe" id="toggle-password-show-confirm" class="eye-icon" style="display: none;">
                    </i>
                </div>
                <button type="submit" class="btn-save">Enregistrer</button>
            </form>
        </div>
    </section>

    <script src="../JS/mdp.js"></script>
</body>

</html>
