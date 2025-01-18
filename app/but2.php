<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUT Informatique</title>
    <link rel="stylesheet" href="../CSS/aside.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/card.css">
    <link rel="stylesheet" href="../CSS/TBD.css">
    <link rel="stylesheet" href="../CSS/t.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
        integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
</head>

<?php require_once(__DIR__ . "//component/header.php");
require_once(__DIR__ . "//component/aside.php");
?>

<body class="body">
    <section id="one">
        <h1 id="titre">BUT Informatique</h1>
        <?php require "component/notification.php" ?>
    </section>

    <script src="../JS/notif.js"></script>
</body>

</html>
<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=sae3.01;charset=utf8', 'root','');

// Requête pour obtenir les étudiants en BUT2
$sql = "SELECT utilisateur.nom, utilisateur.prenom
        FROM utilisateur
        JOIN etudiant ON utilisateur.id = etudiant.Id
        JOIN inscription ON etudiant.Id = inscription.Id_Etudiant
        WHERE inscription.numSemestre = 4";

$stmt = $pdo->query($sql);
$etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section id="etudiants">
    <h2>Étudiants en BUT2</h2>
    <div class="container">
        <?php foreach ($etudiants as $etudiant): ?>
            <div class="card clickable-card">
                <div class="container">
                    <h3 class="nom"><?= htmlspecialchars($etudiant['nom']) ?> <?= htmlspecialchars($etudiant['prenom']) ?></h3>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
