<?php
// Initialisation des variables
$error_message_info = $error_message_mdp = $error_message = $success_message = "";
$prenom_nom = $email = $telephone = $formation = $semestre = "";
$new_mdp = $confirm_mdp = "";

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sécurisation des données avec htmlspecialchars pour éviter les failles XSS
    $prenom_nom = isset($_POST['prenom-nom']) ? htmlspecialchars($_POST['prenom-nom']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $telephone = isset($_POST['telephone']) ? htmlspecialchars($_POST['telephone']) : '';
    $formation = isset($_POST['formation']) ? htmlspecialchars($_POST['formation']) : '';
    $semestre = isset($_POST['semestre']) ? htmlspecialchars($_POST['semestre']) : '';
    $new_mdp = isset($_POST['new-mdp']) ? htmlspecialchars($_POST['new-mdp']) : '';
    $confirm_mdp = isset($_POST['confirm-mdp']) ? htmlspecialchars($_POST['confirm-mdp']) : '';
    
    // Validation des informations personnelles
    if (strlen($prenom_nom) < 2) {
        $error_message_info = "Le prénom et le nom doivent comporter au moins 2 caractères.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message_info = "❌ Adresse email invalide.";
    } else {
        $success_message = "✔️ Informations personnelles sauvegardées avec succès.";
    }

    // Validation du mot de passe
    if ($new_mdp !== $confirm_mdp) {
        $error_message_mdp = "❌ Les mots de passe ne correspondent pas.";
    } elseif (strlen($new_mdp) < 8) {
        $error_message_mdp = "❌ Le mot de passe doit contenir au moins 8 caractères.";
    } else {
        if (empty($error_message_info)) {
            $success_message = "✔️ Mot de passe changé avec succès.";
        }
    }

    // Validation de la formation et du semestre
    if ($formation == "BUT 1" && ($semestre < 3 || $semestre > 4)) {
        $error_message_info = "❌ Le semestre sélectionné n'est pas valide pour la formation BUT 1.";
    } elseif ($formation == "BUT 2" && ($semestre < 3 || $semestre > 5)) {
        $error_message_info = "❌ Le semestre sélectionné n'est pas valide pour la formation BUT 2.";
    } elseif ($formation == "BUT 3" && ($semestre < 5 || $semestre > 6)) {
        $error_message_info = "❌ Le semestre sélectionné n'est pas valide pour la formation BUT 3.";
    }
}
require_once(__DIR__ . "//component/header.php");
require_once(__DIR__ . "//component/aside.php");
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
                    <label for="prenom-nom">Prénom - Nom</label>
                    <input type="text" id="prenom-nom" name="prenom-nom" value="<?= htmlspecialchars($prenom_nom) ?>" placeholder="Entrez votre Prénom et Nom" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" placeholder="Entrez votre Email" required>
                </div>
                <div class="form-group">
                    <label for="telephone">Numéro de téléphone</label>
                    <input type="tel" id="telephone" name="telephone" value="<?= htmlspecialchars($telephone) ?>" placeholder="Entrez votre Numéro de téléphone" required>
                </div>
                <div class="form-group">
                    <label for="formation">Formation</label>
                    <select id="formation" name="formation" required>
                        <option value="" <?= $formation == "" ? "selected" : "" ?>>Sélectionnez votre formation</option>
                        <option value="BUT 1" <?= $formation == "BUT 1" ? "selected" : "" ?>>BUT 1</option>
                        <option value="BUT 2" <?= $formation == "BUT 2" ? "selected" : "" ?>>BUT 2</option>
                        <option value="BUT 3" <?= $formation == "BUT 3" ? "selected" : "" ?>>BUT 3</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="semestre">Semestre</label>
                    <select id="semestre" name="semestre" required>
                        <option value="" <?= $semestre == "" ? "selected" : "" ?>>Sélectionnez votre semestre</option>
                        <option value="1" <?= $semestre == "3" ? "selected" : "" ?>>Semestre 1</option>
                        <option value="2" <?= $semestre == "3" ? "selected" : "" ?>>Semestre 2</option>
                        <option value="3" <?= $semestre == "3" ? "selected" : "" ?>>Semestre 3</option>
                        <option value="4" <?= $semestre == "4" ? "selected" : "" ?>>Semestre 4</option>
                        <option value="5" <?= $semestre == "5" ? "selected" : "" ?>>Semestre 5</option>
                        <option value="6" <?= $semestre == "6" ? "selected" : "" ?>>Semestre 6</option>
                    </select>
                </div>
                <button type="submit" class="btn-save">Enregistrer</button>
            </form>
        </div>

        <?php if($error_message): ?>
            <div class="error-message" style="color: red;"><?= $error_message ?></div>
        <?php elseif($success_message): ?>
            <div class="success-message" style="color: green;"><?= $success_message ?></div>
        <?php endif; ?>
    </section>

    <script src="../JS/profil.js"></script>
</body>

</html>