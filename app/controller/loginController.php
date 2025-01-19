<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require "../model/utilisateur.php";
$user = new Utilisateur();

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['connexion'])) {
    session_start();
    $identifiant = htmlspecialchars(trim($_POST['identifiant']), ENT_QUOTES, 'UTF-8');
    $password = $_POST['password'];

    if (empty($identifiant) || empty($password)) {
        die("Tous les champs doivent être remplis.");
    }

    try {
        $userModel = new Utilisateur();

        $user = $userModel->login($identifiant);

        if ($user && password_verify($password, $user['password'])) {
            // Connexion réussie
            $_SESSION['user'] = [
                'id' => $user['id'],
                'nom' => $user['nom'],
                'prenom' => $user['prenom'],
                'email' => $user['email'],
                'role' => $user['role'],
            ];
            if ($_SESSION['user']['role'] == "etudiant") {
                header('Location: board.php');
                exit(); // Évite les failles de sécurité en arrêtant l'exécution
            } elseif ($_SESSION['user']['role'] == "enseignant") {
               // header('Location: board.php');
                exit();
            } elseif ($_SESSION['user']['role'] == "administrateur") {
                header('Location: dpt.php');
                exit();
            } elseif ($_SESSION['user']['role'] == "tuteur") {
                header('Location: board_entreprise.php'); // Page pour les tuteurs
                exit();
            } else {
                // Si aucun rôle valide n'est trouvé
                header('Location: unauthorized.php'); // Page d'accès refusé
                exit();
            }
        } else {
            // Identifiant ou mot de passe incorrect
            echo "Identifiant ou mot de passe incorrect.";
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        die("Une erreur s'est produite. Veuillez réessayer plus tard.");
    }
}
?>
?>
