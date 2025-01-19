<?php
require_once('./controller/sessionController.php');
require_once(__DIR__ . "//component/header.php");
require_once(__DIR__ . "//component/aside.php");
require_once("controller/updateController.php");
?>

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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
</head>

<body>
    <section id="one">
        <div class="title-section">
            <h1>Modifier le mot de passe</h1>
        </div>

        <div class="mdp-section">
            <form class="mdp-form" method="POST" action="">
                <div class="form-group">
                    <label for="new-mdp">Nouveau mot de passe (minimum 8 caractères)</label>
                    <input type="password" id="new-mdp" name="new-mdp" placeholder="Entrez votre nouveau mot de passe" required>
                    <i class="mdp-gestion">
                        <img src="../IMG/icones/mdp1.png" alt="Masquer le mot de passe" id="toggle-password" class="eye-icon">
                        <img src="../IMG/icones/mdp.png" alt="Afficher le mot de passe" id="toggle-password-show" class="eye-icon" style="display: none;">
                    </i>
                </div>
                <div class="form-group">
                    <label for="confirm-mdp">Confirmation du mot de passe</label>
                    <input type="password" id="confirm-mdp" name="confirm-mdp" placeholder="Confirmez votre mot de passe" required>
                    <i class="mdp-gestion">
                        <img src="../IMG/icones/mdp1.png" alt="Masquer le mot de passe" id="toggle-password-confirm" class="eye-icon">
                        <img src="../IMG/icones/mdp.png" alt="Afficher le mot de passe" id="toggle-password-show-confirm" class="eye-icon" style="display: none;">
                    </i>
                </div>
                <button type="submit" class="btn-save">Enregistrer</button>
            </form>
        </div>

        <div class="title-section">
            <h1>Mes informations</h1>
        </div>
        <div class="mdp-section">
            <form class="mdp-form" method="POST" action="">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($nom) ?>" placeholder="Entrez votre Nom" required>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($prenom) ?>" placeholder="Entrez votre Prénom" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" placeholder="Entrez votre Email" required>
                </div>
                <div class="form-group">
                    <label for="telephone">Numéro de téléphone</label>
                    <input type="tel" id="telephone" name="telephone" value="<?= htmlspecialchars($telephone) ?>" placeholder="Entrez votre Numéro de téléphone" required>
                </div>
                <button type="submit" class="btn-save">Enregistrer</button>
            </form>
        </div>

        <!-- Affichage des messages d'erreur ou de succès -->
        <?php if($error_message_info || $error_message_mdp): ?>
            <div class="error-message" style="color: red;">
                <?php echo $error_message_info; ?>
                <?php echo $error_message_mdp; ?>
            </div>
        <?php elseif($success_message): ?>
            <div class="success-message" style="color: green;">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>
    </section>

    <script src="../JS/profil.js"></script>
</body>

</html>
