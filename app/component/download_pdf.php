<?php
// Spécifiez le chemin vers votre fichier PDF
$filename = "pdf/B.pdf";

if (file_exists($filename)) {
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');
    readfile($filename);
    exit;
} else {
    echo "Le fichier demandé n'existe pas.";
}
?>
