<?php
// Chemin vers le fichier PDF à télécharger
$filename = "../pdf/Bordereau de stage 2024-25 BUT2";

if (file_exists($filename)) {
    // En-têtes pour forcer le téléchargement
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');
    readfile($filename);
    exit;
} else {
    // Message d'erreur si le fichier n'existe pas
    echo "Le fichier demandé n'existe pas.";
}
?>
