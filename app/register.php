<?php
require "../model/utilisateur.php";
$user = new Utilisateur();




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    $identifiant = htmlspecialchars(trim($_POST['identifiant']), ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars(trim($_POST['password']), ENT_QUOTES, 'UTF-8');
    $nom = htmlspecialchars(trim($_POST['nom']), ENT_QUOTES, 'UTF-8');
    $prenom = htmlspecialchars(trim($_POST['prenom']), ENT_QUOTES, 'UTF-8');
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $tel = htmlspecialchars(trim($_POST['tel']), ENT_QUOTES, 'UTF-8');


    if (empty($identifiant) || empty($password) || empty($nom) || empty($prenom) || empty($email) || empty($tel)) {
        die("Tous les champs doivent être remplis.");
    }

  
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Adresse email invalide.");
    }

    $spec = '$argon2id$v=19$m=262144,t=4,p=2'; // Configuration du hachage

    $passwordHashed = password_hash($password, PASSWORD_ARGON2ID, [
        'memory_cost' => 256 * 1024, 
        'time_cost' => 4,           
        'threads' => 2              
    ]);

    $newpasswordHash = str_replace($spec, "", $passwordHashed);

    if (!$passwordHashed) {
        die("Une erreur s'est produite lors du hachage du mot de passe.");
    }

 
    $data = [
        'nom' => $nom,
        'prenom' => $prenom,
        'login' => $identifiant,
        'password' => $newpasswordHash,
        'email' => $email,
        'tel' => $tel
    ];

    try {
     
        $user = new Utilisateur(); 
        $userId = $user->register($data);

        if ($userId) {
    
            $_SESSION['user'] = [
                'id' => $userId,
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email
            ];

            header('Location: board.php');
            exit();
        } else {
            echo "Erreur lors de l'enregistrement de l'utilisateur.";
        }
    } catch (Exception $e) {
        die("Une erreur s'est produite. Veuillez réessayer plus tard.");
    }
} 
?>



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
            <h1>Register</h1>
            <form action="register.php" method="post">
                <div class="champ-input">
                    <label for="identifiant">nom</label>
                    <div class="input-wrapper">
                        <img src="../IMG/icones/profile.png" alt="Icône Utilisateur" class="input-icon">
                        <input type="text" name="nom" id="nom" placeholder="Votre nom">
                    </div>
                    <label for="identifiant">prenom</label>
                    <div class="input-wrapper">
                        <img src="../IMG/icones/profile.png" alt="Icône Utilisateur" class="input-icon">
                        <input type="text" name="prenom" id="prenom" placeholder="Votre prenom">
                    </div>
                    <label for="identifiant">email</label>
                    <div class="input-wrapper">
                        <img src="../IMG/icones/profile.png" alt="Icône Utilisateur" class="input-icon">
                        <input type="text" name="email" id="email" placeholder="Votre email">
                    </div>
                    <label for="identifiant">tel</label>
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