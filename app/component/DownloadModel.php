<?php
// Spécifiez le chemin vers votre fichier PDF
require_once __DIR__ . '/../../model/typeAction.php';
$action = new TypeAction();

if (isset($_GET['idAction'])) {
    $idAction = intval($_GET['idAction']); // Sécurisation avec intval pour s'assurer que c'est un entier
    $name =  $action->selectActionById($idAction);
    $path = "../../pdf/";
    $filename = $path . $name['LienModeleDoc'];
    if (file_exists($filename)) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        readfile($filename);
        exit;
    } else {
        header('Location: ../../depot.php');
        exit;
    }

    // Vous pouvez ensuite l'utiliser pour des requêtes ou autres traitements
} else {
   header('Location: ../../depot.php');
    exit;
}

// ?>