<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once "../../config/database.php";

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

        if (empty($_POST['studentId']) || empty($_POST['stageId'])) {
            echo json_encode(["status" => "error", "message" => "Identifiants manquants (étudiant ou stage)."]);
            exit();
        }

        $studentId = $_POST['studentId'];
        $stageId = $_POST['stageId'];
        $nomUser = $_POST['NomUser'];
        $prenomUser = $_POST['prenomUser'];
        $nomDestination = "Convention-" . $studentId . "-" . $nomUser . "_" . $prenomUser . "." . $extensionFichier;

        $dossierUpload = "../../document";
        if (!file_exists($dossierUpload)) {
            mkdir($dossierUpload, 0777, true);
        }

        $repertoireDestination = $dossierUpload . "/";
        if (move_uploaded_file($_FILES['document']['tmp_name'], $repertoireDestination . $nomDestination)) {
            try {
                $bd = Database::getConnexion('mysql');

                // 🔍 Récupérer annee, id_departement, num_semestre depuis la table stage
                $stageInfo = $bd->prepare('
                    SELECT annee, id_departement, num_semestre 
                    FROM stage 
                    WHERE id_etudiant = :studentId AND id_stage = :stageId
                ');
                $stageInfo->execute([
                    ':studentId' => $studentId,
                    ':stageId' => $stageId
                ]);

                $stageData = $stageInfo->fetch(PDO::FETCH_ASSOC);

                if (!$stageData) {
                    echo json_encode(["status" => "error", "message" => "Aucun stage trouvé pour cet étudiant."]);
                    exit();
                }

                $annee = $stageData['annee'];
                $idDepartement = $stageData['id_departement'];
                $numSemestre = $stageData['num_semestre'];

                $dateRealisation = date('Y-m-d');
                $cheminRelatif = "../document/" . $nomDestination;

                // 🟢 Insertion dans la table action
                $requete = $bd->prepare('
                    INSERT INTO `action` (
                        annee, id_departement, num_semestre, 
                        id_etudiant, id_stage, date_realisation, 
                        lien_document, id_type_action, Id, etat
                    )
                    VALUES (
                        :annee, :idDepartement, :numSemestre, 
                        :studentId, :stageId, :dateRealisation, 
                        :filePath, 9, :actionId, "a faire"
                    )
                ');

                $requete->execute([
                    ':annee' => $annee,
                    ':idDepartement' => $idDepartement,
                    ':numSemestre' => $numSemestre,
                    ':studentId' => $studentId,
                    ':stageId' => $stageId,
                    ':dateRealisation' => $dateRealisation,
                    ':filePath' => $cheminRelatif,
                    ':actionId' => $studentId
                ]);

                echo json_encode([
                    "status" => "success",
                    "message" => "Document téléchargé et enregistré avec succès."
                ]);
            } catch (PDOException $e) {
                echo json_encode([
                    "status" => "error",
                    "message" => "Erreur lors de l'enregistrement : " . $e->getMessage()
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
