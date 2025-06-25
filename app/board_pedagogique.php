<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'pedagogique') {
    header('Location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord Pédagogique</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/aside.css">
    <link rel="stylesheet" href="../CSS/header_pedagogique.css">
    <link rel="stylesheet" href="../CSS/listEtudiant_pedagogique.css">
</head>
<body>
<div class="component_container">
    <?php
    include('./component/header.php');
    include('./component/aside.php');
?>
</div>

<div id="main-content" data-loaded=""></div>


<?php require_once __DIR__ . '/component/notification.php'; ?>

<script src="../JS/script_pedagogique.js"></script>
</body>
</html>
