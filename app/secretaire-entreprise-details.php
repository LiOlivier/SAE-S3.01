<?php
session_start();
require_once(__DIR__ . "/../config/database.php");

try {
    $db = Database::getConnexion('mysql');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec("USE sorbonne");

    if (isset($_GET['id'])) {
        $tuteurId = (int)$_GET['id'];

        // Fetch tuteur and enterprise details
        $query = 'SELECT u.nom, u.prenom, u.email, u.telephone, e.adresse, e.code_postal, e.ville, e.tel as entreprise_tel 
                  FROM Tuteur_Entreprise te 
                  JOIN Utilisateur u ON te.Id_Tuteur_Entreprise = u.id 
                  JOIN entreprise e ON te.id_entreprise = e.id_entreprise 
                  WHERE te.Id_Tuteur_Entreprise = :id';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $tuteurId, PDO::PARAM_INT);
        $stmt->execute();
        $tuteur = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($tuteur) {
            // Count students under control
            $query = 'SELECT COUNT(DISTINCT s.id_etudiant) as student_count 
                      FROM stage s 
                      WHERE s.id_tuteur_entreprise = :id';
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $tuteurId, PDO::PARAM_INT);
            $stmt->execute();
            $studentCount = $stmt->fetchColumn();
        } else {
            die("Tuteur non trouvé.");
        }
    } else {
        die("ID du tuteur non spécifié.");
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
    <title>Détails du Tuteur Entreprise</title>
    <link rel="stylesheet" href="../CSS/aside.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/secretaire.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
          integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <style>
        .details-container {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            max-width: 600px;
        }
        .details-item {
            margin-bottom: 10px;
        }
        .details-item label {
            font-weight: bold;
            margin-right: 10px;
        }
        .clickable-row {
            cursor: pointer;
        }
        .clickable-row:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body class="body">
    <?php require_once(__DIR__ . "/component/header.php"); ?>
    <?php require_once(__DIR__ . "/component/aside.php"); ?>
    <section id="one">
        <h1 id="titre">Détails du Tuteur Entreprise</h1>
        <div class="cards">
            <?php if ($tuteur): ?>
                <div class="details-container">
                    <div class="details-item"><label>Nom :</label> <?= htmlspecialchars($tuteur['nom'] ?? 'N/A') ?></div>
                    <div class="details-item"><label>Prénom :</label> <?= htmlspecialchars($tuteur['prenom'] ?? 'N/A') ?></div>
                    <div class="details-item"><label>Email :</label> <?= htmlspecialchars($tuteur['email'] ?? 'N/A') ?></div>
                    <div class="details-item"><label>Téléphone :</label> <?= htmlspecialchars($tuteur['telephone'] ?? 'N/A') ?></div>
                    <div class="details-item"><label>Adresse Entreprise :</label> <?= htmlspecialchars($tuteur['adresse'] ?? 'N/A') ?></div>
                    <div class="details-item"><label>Code Postal :</label> <?= htmlspecialchars($tuteur['code_postal'] ?? 'N/A') ?></div>
                    <div class="details-item"><label>Ville :</label> <?= htmlspecialchars($tuteur['ville'] ?? 'N/A') ?></div>
                    <div class="details-item"><label>Téléphone Entreprise :</label> <?= htmlspecialchars($tuteur['entreprise_tel'] ?? 'N/A') ?></div>
                    <div class="details-item"><label>Nombre d'Étudiants sous Contrôle :</label> <?= htmlspecialchars($studentCount ?? '0') ?></div>
                </div>
                <?php if ($studentCount > 0): ?>
                    <section id="students-under-control">
                        <h2>Étudiants sous Contrôle</h2>
                        <div class="cards">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Nom de l'Étudiant</th>
                                        <th>Prénom</th>
                                        <th>Email</th>
                                        <th>Année de Stage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = 'SELECT u.nom, u.prenom, u.email, s.annee, e.id_etudiant 
                                              FROM stage s 
                                              JOIN Etudiant e ON s.id_etudiant = e.id_etudiant 
                                              JOIN Utilisateur u ON e.id_etudiant = u.id 
                                              WHERE s.id_tuteur_entreprise = :id';
                                    $stmt = $db->prepare($query);
                                    $stmt->bindParam(':id', $tuteurId, PDO::PARAM_INT);
                                    $stmt->execute();
                                    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    if ($students) {
                                        foreach ($students as $student) {
                                            echo '<tr class="clickable-row" onclick="window.location.href=\'secretaire-student-details.php?id=' . htmlspecialchars($student['id_etudiant'], ENT_QUOTES) . '\'">';
                                            echo '<td>' . htmlspecialchars($student['nom'], ENT_QUOTES) . '</td>';
                                            echo '<td>' . htmlspecialchars($student['prenom'], ENT_QUOTES) . '</td>';
                                            echo '<td>' . htmlspecialchars($student['email'], ENT_QUOTES) . '</td>';
                                            echo '<td>' . htmlspecialchars($student['annee'], ENT_QUOTES) . '</td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="4">Aucun étudiant sous contrôle pour le moment.</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </section>
                <?php endif; ?>
                <a href="secretaire-tuteurs-entreprise.php">Retour à la liste</a>
            <?php endif; ?>
        </div>
    </section>
</body>
</html>