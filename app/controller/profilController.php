<?php
require_once __DIR__ . '/../models/utilisateur.php';

class profilController {
    public static function handle() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        echo '<pre>';
        print_r($_SESSION);
        echo '</pre>';
        exit;

        $userId = $_SESSION['user']['id'] ?? null;

        if (!$userId) {
            header("Location: index.php?page=login");
            exit;
        }

        $utilisateur = new Utilisateur();
        $success_message = "";
        $error_message_info = "";
        $error_message_mdp = "";

        if (!empty($_POST['nom'])) {
            $utilisateur->updateUtilisateur(
                $userId,
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['email'],
                $_POST['telephone']
            );
            $success_message = "Profil mis à jour.";
        }

        $login = $_SESSION['user']['login'] ?? null;

        echo '<pre>SESSION APRÈS CONNEXION : ';
        print_r($_SESSION);
        echo '</pre>';
        exit;

        if (!$login) {
            die("Erreur : Login utilisateur non défini dans la session.");
        }

        $user = $utilisateur->login($login);

        $nom = $user['nom'];
        $prenom = $user['prenom'];
        $email = $user['email'];
        $telephone = $user['telephone'];

        require __DIR__ . '/../views/utilisateur/profilView.php';
    }
}
