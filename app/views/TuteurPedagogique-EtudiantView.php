<link rel="stylesheet" href="../CSS/documentEtudiant.css">
<button id="backButton" onclick="goBack()">Retour</button>

<div id='bloc-etudiant'>
    <h1><?= strtoupper($student['nom']) . " " . $student['prenom'] ?> - BUT <?= $student['Libelle'] ?></h1>
    <h2><?= $student["email"] ?> - <?= $student["telephone"] ?></h2>
</div>
<?php
function renderSection($type, $etat, $studentId, $nom, $prenom, $stageId, $tuteur) {
    $color = $etat === "Tâche complète" ? "green" : "red";
    $disabled = $etat === "En attente" ? 'disabled style="background-color:grey;color:white;"' : "";
    $docLabel = ucfirst($type);
    $filename = "$docLabel-$studentId-$nom" . "_" . $prenom . ".pdf";

    echo "
    <div class='document-section'>
            <h3>$docLabel de stage</h3>
            <form action='telechargement_pedagogique.php' method='POST'>
                <input type='hidden' name='studentId' value='$studentId'>
                <input type='hidden' name='documentType' value='$type'>
                <input type='hidden' name='nomDoc' value='$filename'>
                <p>État actuel : <span class='{$type}-etat' style='color:$color'>$etat</span></p>
                <button type='submit' name='action' value='telecharger' $disabled>Télécharger</button>
            </form>";

    if ($type === "convention") {
        echo "<form action='./component/upload_handler_pedagogique.php' method='POST' enctype='multipart/form-data'>
                <input type='hidden' name='studentId' value='$studentId'>
                <input type='hidden' name='stageId' value='$stageId'>
                <input type='hidden' name='NomUser' value='{$tuteur['nom']}'>
                <input type='hidden' name='prenomUser' value='{$tuteur['prenom']}'>
                <input type='hidden' name='documentType' value='convention'>
                <label for='document'>Importer votre convention :</label><br>
                <input type='file' name='document' required><br><br>
                <button type='submit' name='action' value='confirmer'>Confirmer</button>
              </form>";
    }

    echo "</div>";
}

renderSection("bordereau", $student["BordereauEtat"], $studentId, $student["nom"], $student["prenom"], $student["id_stage"], $tuteur);
renderSection("convention", $student["ConventionEtat"], $studentId, $student["nom"], $student["prenom"], $student["id_stage"], $tuteur);
renderSection("rapport", $student["RapportEtat"], $studentId, $student["nom"], $student["prenom"], $student["id_stage"], $tuteur);
?>