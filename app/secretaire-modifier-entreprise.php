<?php
session_start();
require_once(__DIR__ . "/../config/database.php");

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

try {
    $db = Database::getConnexion('mysql');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec("USE sorbonne");

    $stmt = $db->prepare("SELECT u.nom, u.prenom, u.email, u.telephone, te.id_entreprise 
                          FROM Tuteur_Entreprise te 
                          JOIN Utilisateur u ON te.Id_Tuteur_Entreprise = u.id 
                          WHERE te.Id_Tuteur_Entreprise = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $tuteur = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$tuteur) {
        die("Tuteur non trouvé.");
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $telephone = htmlspecialchars($_POST['telephone']);
        $id_entreprise = (int)$_POST['id_entreprise'];

        $stmt = $db->prepare("UPDATE Utilisateur SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone WHERE id = :id");
        $stmt->execute([':id' => $id, ':nom' => $nom, ':prenom' => $prenom, ':email' => $email, ':telephone' => $telephone]);

        $stmt = $db->prepare("UPDATE Tuteur_Entreprise SET id_entreprise = :id_entreprise WHERE Id_Tuteur_Entreprise = :id");
        $stmt->execute([':id' => $id, ':id_entreprise' => $id_entreprise]);

        header("Location: secretaire-tuteurs-entreprise.php");
        exit();
    }
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Tuteur Entreprise</title>
    <link rel="stylesheet" href="../CSS/aside.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/secretaire.css">
</head>
<body class="body">
    <?php require_once(__DIR__ . "/component/header.php"); ?>
    <?php require_once(__DIR__ . "/component/aside.php"); ?>
    <div id="one">
        <h1 id="titre">Modifier Tuteur Entreprise</h1>
        <div class="cards">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($tuteur['nom'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($tuteur['prenom'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($tuteur['email'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="telephone">Téléphone :</label>
                    <input type="text" id="telephone" name="telephone" value="<?= htmlspecialchars($tuteur['telephone'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="id_entreprise">ID Entreprise :</label>
                    <input type="number" id="id_entreprise" name="id_entreprise" value="<?= htmlspecialchars($tuteur['id_entreprise'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <button type="submit">Enregistrer</button>
                    <a href="secretaire-tuteurs-entreprise.php"><button type="button">Annuler</button></a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>