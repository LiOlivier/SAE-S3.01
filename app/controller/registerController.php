<?php
require "../model/utilisateur.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    $identifiant = htmlspecialchars(trim($_POST['identifiant']), ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars(trim($_POST['password']), ENT_QUOTES, 'UTF-8');
    $nom = htmlspecialchars(trim($_POST['nom']), ENT_QUOTES, 'UTF-8');//trim pour suprimmer les espaces
    $prenom = htmlspecialchars(trim($_POST['prenom']), ENT_QUOTES, 'UTF-8');
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $tel = htmlspecialchars(trim($_POST['tel']), ENT_QUOTES, 'UTF-8');


    if (empty($identifiant) || empty($password) || empty($nom) || empty($prenom) || empty($email) || empty($tel)) {
        die("Tous les champs doivent être remplis.");
    }

  
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Adresse email invalide.");
    }


    $passwordHashed = password_hash($password, PASSWORD_ARGON2ID, [
        'memory_cost' => 256 * 1024, 
        'time_cost' => 4,           
        'threads' => 2              
    ]);


    if (!$passwordHashed) {
        die("Une erreur s'est produite lors du hachage du mot de passe.");
    }

 
    $data = [
        'nom' => $nom,
        'prenom' => $prenom,
        'login' => $identifiant,
        'password' => $passwordHashed,
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

