<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

require_once __DIR__ . '/../../model/typeAction.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['sortDocument']) && $_FILES['sortDocument']['error'] === UPLOAD_ERR_OK) {
        $nomOrigine = $_FILES['sortDocument']['name'];
        $elementsChemin = pathinfo($nomOrigine);
        $extensionFichier = strtolower($elementsChemin['extension']);
        $extensionsAutorisees = ["jpeg", "jpg", "gif", "png", "pdf"];
        $idAction = $_POST["actionId"];
        $libele = $_POST["libelle"];
        $nom = $_POST["nom"];

        if (!in_array($extensionFichier, $extensionsAutorisees)) {
            echo json_encode([
                "status" => "error",
                "message" => "Extension de fichier non autorisée."
            ]);
            exit();
        }

        $idNewSujet = $idAction; 
        $nomDestination = $libele . "-"  . $nom . "." . $extensionFichier;
        $dossierUpload = "../../document";

        if (!file_exists($dossierUpload)) {
            mkdir($dossierUpload, 0777, true);
        }

        $repertoireDestination = realpath($dossierUpload) . "/";

        
        $extensionsExistantes = ["jpeg", "jpg", "gif", "png", "pdf"];
        foreach ($extensionsExistantes as $ext) {
            $fichierExistant = $repertoireDestination . "document-" . $idNewSujet . "." . $ext;
            if (file_exists($fichierExistant)) {
                unlink($fichierExistant); 
            }
        }

        if ($_FILES['sortDocument']['error'] > 0) {
            echo json_encode([
                "status" => "error",
                "message" => 'Erreur lors de l\'upload: ' . $_FILES['sortDocument']['error']
            ]);
            exit();
        }

        if (move_uploaded_file($_FILES["sortDocument"]["tmp_name"], $repertoireDestination . $nomDestination)) {
            $action = new TypeAction();
            $action->updateDocument($idAction, $nomDestination);
            echo json_encode([
                "status" => "success",
                "message" => "Fichier téléchargé avec succès."
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Erreur lors du téléchargement du fichier."
            ]);
        }
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Aucun fichier ou erreur lors de l'upload."
        ]);
    }
}
?>
