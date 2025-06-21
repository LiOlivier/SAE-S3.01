<?php

require_once __DIR__ . '/../../model/typeAction.php';
$action = new TypeAction();

if (isset($_GET['idAction'])) {
    $idAction = intval($_GET['idAction']); 
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


} else {
   header('Location: ../../depot.php');
    exit;
}

 ?>