<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'Enseignant</title>
    <link rel="stylesheet" href="../CSS/aside.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/secretaire.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
        integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
</head>

<body class="body">
    <?php 
        require_once(__DIR__ . "/component/header.php");
        require_once(__DIR__ . "/component/aside.php"); 
        require_once "../config/database.php";
    ?>

    <section id="one">
        <h1 id="titre">Détails de l'Enseignant</h1>
        <div class="cards">
            <?php
            $db = Database::getConnexion('mysql'); 
            try {
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $db->exec("USE sorbonne");

                if (isset($_GET['id'])) {
                    $enseignantId = $_GET['id'];

                    $query = 'SELECT utilisateur.nom, utilisateur.prenom, utilisateur.email, utilisateur.telephone, enseignant.bureau, utilisateur.role 
                              FROM enseignant 
                              JOIN utilisateur ON enseignant.id_enseignant = utilisateur.id 
                              WHERE enseignant.id_enseignant = :enseignantId';
                    $stmt = $db->prepare($query);
                    $stmt->bindParam(':enseignantId', $enseignantId, PDO::PARAM_INT);
                    $stmt->execute();
                    $enseignant = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($enseignant) {
                        echo '<p><strong>Nom:</strong> ' . htmlspecialchars($enseignant['nom'], ENT_QUOTES) . '</p>';
                        echo '<p><strong>Prénom:</strong> ' . htmlspecialchars($enseignant['prenom'], ENT_QUOTES) . '</p>';
                        echo '<p><strong>Email:</strong> ' . htmlspecialchars($enseignant['email'], ENT_QUOTES) . '</p>';
                        echo '<p><strong>Téléphone:</strong> ' . htmlspecialchars($enseignant['telephone'], ENT_QUOTES) . '</p>';
                        echo '<p><strong>Bureau:</strong> ' . htmlspecialchars($enseignant['bureau'] ?? 'Non spécifié', ENT_QUOTES) . '</p>';

                        $query = 'SELECT libelle FROM departement WHERE id_enseignant = :enseignantId';
                        $stmt = $db->prepare($query);
                        $stmt->bindParam(':enseignantId', $enseignantId, PDO::PARAM_INT);
                        $stmt->execute();
                        $dept = $stmt->fetchColumn();

                        if ($dept) {
                            echo '<p><strong>Département (Responsable):</strong> ' . htmlspecialchars($dept, ENT_QUOTES) . '</p>';
                        }

                        if ($enseignant['role'] === 'pedagogique') {
                            echo '<section id="students-under-control">';
                            echo '<h2>Étudiants sous Contrôle</h2>';
                            echo '<div class="cards">';
                            echo '<table>';
                            echo '<thead><tr><th>Nom de l\'Étudiant</th><th>Prénom</th><th>Email</th><th>Année de Stage</th></tr></thead>';
                            echo '<tbody>';
                            $query = 'SELECT utilisateur.nom, utilisateur.prenom, utilisateur.email, stage.annee, Etudiant.id_etudiant 
                                      FROM Etudiant 
                                      JOIN utilisateur ON Etudiant.id_etudiant = utilisateur.id 
                                      JOIN stage ON Etudiant.id_etudiant = stage.id_etudiant 
                                      WHERE stage.id_enseignant_1 = :enseignantId OR stage.id_enseignant_2 = :enseignantId';
                            $stmt = $db->prepare($query);
                            $stmt->bindParam(':enseignantId', $enseignantId, PDO::PARAM_INT);
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
                            echo '</tbody></table>';
                            echo '</div></section>';
                        }
                    } else {
                        echo '<p>Aucun enseignant trouvé avec cet ID.</p>';
                    }
                } else {
                    echo '<p>ID de l\'enseignant non spécifié.</p>';
                }
            } catch (PDOException $e) {
                echo 'Erreur : ' . $e->getMessage();
            }
            ?>
        </div>
    </section>
</body>
</html>