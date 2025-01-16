<?php
// Spécifiez le chemin vers votre fichier PDF
$filename = __DIR__ . "/pdf/B.pdf"; // Chemin complet du fichier

if (file_exists($filename)) {
    // En-têtes pour forcer le téléchargement
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');
    // Lire le fichier
    readfile($filename);
    exit;
} else {
    // Afficher un message d'erreur si le fichier n'existe pas
    echo "Le fichier demandé n'existe pas.";
}
?>
