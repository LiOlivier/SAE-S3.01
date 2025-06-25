<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['document']) && $_FILES['document']['error'] === UPLOAD_ERR_OK) {

        $nomOrigine = $_FILES['document']['name'];
        $elementsChemin = pathinfo($nomOrigine);
        $extensionFichier = strtolower($elementsChemin['extension']);
        $extensionsAutorisees = ["jpeg", "jpg", "gif", "png", "pdf", "docx", "txt"];


        if (!in_array($extensionFichier, $extensionsAutorisees)) {
            echo json_encode(["status" => "error", "message" => "Extension de fichier non autorisée."]);
            exit();
        }

        if (empty($_POST['studentId'])) {
            echo json_encode(["status" => "error", "message" => "Identifiant étudiant manquant."]);
            exit();
        }
        $studentId = $_POST['studentId'];
        $stageId = $_POST['stageId'];
        $nomUser = $_POST['NomUser'];
        $prenomUser = $_POST['prenomUser'];


        $nomDestination = "Convention-" . $studentId . "-".$nomUser."_".$prenomUser. "." . $extensionFichier;


        $dossierUpload = "../../document";
        if (!file_exists($dossierUpload)) {
            mkdir($dossierUpload, 0777, true);
        }

        $repertoireDestination = $dossierUpload . "/";


        if (move_uploaded_file($_FILES['document']['tmp_name'], $repertoireDestination . $nomDestination)) {

            try {
                $username = 'root';
                $password = '';
                $bd = new PDO('mysql:host=localhost;dbname=sorbonne', $username, $password);
                $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                

                echo "studentId: $studentId, stageId: $stageId";
                $requete = $bd->prepare('
                INSERT INTO `action`(
                    `annee`, `id_departement`, `num_semestre`, `id_etudiant`, `id_stage`, 
                    `date_realisation`, `lien_document`, `id_type_action`, `id`, `etat`
                ) VALUES (
                    :annee, :id_departement, :num_semestre, :studentId, :stageId, 
                    :dateRealisation, :filePath, 9, :actionId, "a faire"
                )
            ');
                $dateRealisation = date('Y-m-d');

                $cheminRelatif = "../document/" . $nomDestination;
                $requete->bindValue(':annee', 2024, PDO::PARAM_INT);
                $requete->bindValue(':id_departement', 1, PDO::PARAM_INT);
                $requete->bindValue(':num_semestre', 4, PDO::PARAM_INT);
                $requete->bindValue(':studentId', $studentId, PDO::PARAM_INT);
                $requete->bindValue(':stageId', $stageId, PDO::PARAM_INT);
                $requete->bindValue(':dateRealisation', $dateRealisation, PDO::PARAM_STR);
                $requete->bindValue(':filePath', $cheminRelatif, PDO::PARAM_STR);
                $requete->bindValue(':actionId', $studentId, PDO::PARAM_INT);

                $requete->execute();



                exit();
                echo json_encode([
                    "status" => "success",
                    "message" => "Document téléchargé et lié à l'action de l'étudiant avec succès. Veuillez retour la page avant pour voir les changements."
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