<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
<<<<<<< HEAD
require "models/utilisateur.php";
=======
require "../model/utilisateur.php";
>>>>>>> 145365576bb88050561c7ed14ad2574d84df58c3
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

            $_SESSION['user'] = [
                'id' => $user['id'],
                'nom' => $user['nom'],
                'prenom' => $user['prenom'],
                'email' => $user['email'],
                'role' => $user['role'],
            ];
            if ($_SESSION['user']['role'] == "etudiant") {
                header('Location: board.php');
                exit(); 
            } elseif ($_SESSION['user']['role'] == "enseignant") {
                header('Location: board.php');
                exit();
            } elseif ($_SESSION['user']['role'] == "administrateur") {
                header('Location: dpt.php');
                exit();
            } elseif ($_SESSION['user']['role'] == "tuteur") {
                header('Location: board_entreprise.php'); 
                exit();
            } 
            elseif ($_SESSION['user']['role'] == "secretaire") {
<<<<<<< HEAD
                header('Location: secretaire-dashboard.php');
=======
                header('Location: dashboard.php');
>>>>>>> 145365576bb88050561c7ed14ad2574d84df58c3
                exit();
            }
            
            elseif ($_SESSION['user']['role'] == "pedagogique") {
                header('Location: board_pedagogique.php');
                exit();
            }
<<<<<<< HEAD
            
            elseif ($_SESSION['user']['role'] == "chefdept") {
                header('Location: board_chefdpt.php');
                exit();
            } 
             
=======

               elseif ($_SESSION['user']['role'] == "chefdept") {
            header('Location: board_chefdpt.php');
            exit();
            }

>>>>>>> 145365576bb88050561c7ed14ad2574d84df58c3
        } else {

            echo "Identifiant ou mot de passe incorrect.";
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        die("Une erreur s'est produite. Veuillez réessayer plus tard.");
    }
}
?>
?>
