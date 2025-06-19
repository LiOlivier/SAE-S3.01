<?php

// UPDATE POUR LES INFORMATIONS 

<<<<<<< HEAD

require_once "../config/database.php";

try {
    $pdo = Database::getConnexion('mysql');
=======
$host = 'localhost';
$dbname = 'sorbonne'; 
$username = 'root';
$password = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
>>>>>>> 145365576bb88050561c7ed14ad2574d84df58c3
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$nom = isset($_SESSION['user']['nom']) ? $_SESSION['user']['nom'] : '';
$prenom = isset($_SESSION['user']['prenom']) ? $_SESSION['user']['prenom'] : '';
$email = isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : '';
$telephone = isset($_SESSION['user']['telephone']) ? $_SESSION['user']['telephone'] : '';

$error_message_info = '';
$error_message_mdp = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['telephone'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $telephone = htmlspecialchars($_POST['telephone']);
        

        $userId = $_SESSION['user']['id']; 
        
        $query = "UPDATE utilisateur SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':telephone' => $telephone,
            ':id' => $userId
        ]);
        
        $_SESSION['user']['nom'] = $nom;
        $_SESSION['user']['prenom'] = $prenom;
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['telephone'] = $telephone;

        $success_message = "Informations mises à jour avec succès.";
    } else {
        $error_message_info = "Veuillez remplir tous les champs.";
    }

    // Vérifie si l'utilisateur est connecté
    if (isset($_SESSION['user']['id'])) {
        $userId = $_SESSION['user']['id'];
    } else {
        // Si l'utilisateur n'est pas connecté, redirige vers la page de connexion ou affiche une erreur
        header("Location: login.php"); // Exemple de redirection
        exit();
    }

    $error_message_mdp = '';
    $success_message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Mise à jour du mot de passe
        if (!empty($_POST['new-mdp']) && !empty($_POST['confirm-mdp'])) {
            // Vérification que les mots de passe sont valides
            if ($_POST['new-mdp'] === $_POST['confirm-mdp'] && strlen($_POST['new-mdp']) >= 8) {
                $newPassword = password_hash($_POST['new-mdp'], PASSWORD_ARGON2I); // Assure-toi d'utiliser un bon algorithme
                $query = "UPDATE utilisateur SET password = :password WHERE id = :id"; // Met à jour la colonne 'password'
                $stmt = $pdo->prepare($query);
                $stmt->execute([
                    ':password' => $newPassword,
                    ':id' => $userId
                ]);
                $success_message = "Mot de passe mis à jour avec succès.";
            }
            else
            {
                $error_message_mdp = "Les mots de passe ne correspondent pas ou sont trop courts.";
            }
        }
    }
}
?>