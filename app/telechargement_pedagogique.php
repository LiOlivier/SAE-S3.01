<?php
$nomDoc = $_POST['nomDoc'];
$filePath = '../document/'.$nomDoc;
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'. basename($filePath).'"');
readfile($filePath);
?>