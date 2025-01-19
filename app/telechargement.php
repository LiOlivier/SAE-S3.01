<?php
$filePath = '../document/Bordereau.pdf';
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'. basename($filePath).'"');
readfile($filePath);
?>