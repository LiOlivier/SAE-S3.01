<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['document']) && $_FILES['document']['error'] === UPLOAD_ERR_OK) {
        // Récupérer les informations du fichier
        $nomOrigine = $_FILES['document']['name'];
        $elementsChemin = pathinfo($nomOrigine);
        $extensionFichier = strtolower($elementsChemin['extension']);
        $extensionsAutorisees = ["jpeg", "jpg", "gif", "png", "pdf", "docx", "txt"];

        // Vérification de l'extension
        if (!in_array($extensionFichier, $extensionsAutorisees)) {
            echo json_encode(["status" => "error", "message" => "Extension de fichier non autorisée."]);
            exit();
        }

        // Récupération des informations de l'étudiant
        $studentId = $_POST['studentId'];

        // Créer un nom de fichier unique pour éviter les conflits
        $nomDestination = "document-" . $studentId . "-" . uniqid() . "." . $extensionFichier;

        // Dossier de destination pour le document
        $dossierUpload = "../../document";
        if (!file_exists($dossierUpload)) {
            mkdir($dossierUpload, 0777, true);
        }

        $repertoireDestination = realpath($dossierUpload) . "/";

        // Déplacer le fichier vers le répertoire de destination
        if (move_uploaded_file($_FILES['document']['tmp_name'], $repertoireDestination . $nomDestination)) {
            // Connexion à la base de données
            try {
                $username = 'root';
                $password = '';
                $bd = new PDO('mysql:host=localhost;dbname=sae3.0.0', $username, $password);
                $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Mettre à jour le lien du document dans la table action
                $requete = $bd->prepare('
                    INSERT INTO `action`(`annee`, `Id_Departement`, `numSemestre`, `Id_Etudiant`, `Id_Stage`, `date_realisation`, `lienDocument`, `Id_TypeAction`, `Id`) 
                    VALUES (2024,1,4,:studentId,3,:dateRealisation,:filePath,5,:studentId)
                ');

                // Récupérer la date actuelle dans le format 'Y-m-d'
                $dateRealisation = date('Y-m-d');

                // Construire le chemin relatif pour le fichier
                $cheminRelatif = "../../document/" . $nomDestination;

                // Lier les paramètres
                $requete->bindValue(':studentId', $studentId, PDO::PARAM_INT);
                $requete->bindValue(':filePath', $cheminRelatif, PDO::PARAM_STR);
                $requete->bindValue(':dateRealisation', $dateRealisation, PDO::PARAM_STR);

                // Exécuter la requête
                $requete->execute();

                // Réponse succès
                echo json_encode([
                    "status" => "success",
                    "message" => "Document téléchargé et lié à l'action de l'étudiant avec succès."
                ]);
            } catch (PDOException $e) {
                echo json_encode([
                    "status" => "error",
                    "message" => "Erreur lors de l'enregistrement du lien du document dans la table action : " . $e->getMessage()
                ]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Erreur lors du téléchargement du fichier."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Aucun fichier ou erreur lors de l'upload."]);
    }
}
?>
