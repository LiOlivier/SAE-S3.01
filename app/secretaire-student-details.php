<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'Étudiant - Responsable de Stage</title>
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
        <h1 id="titre">Détails de l'Étudiant</h1>
        <div class="cards">
            <?php
            $db = Database::getConnexion('mysql'); 
            try {
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $db->exec("USE sorbonne");

                if (isset($_GET['id'])) {
                    $studentId = $_GET['id'];

                    $query = 'SELECT utilisateur.nom, utilisateur.prenom, utilisateur.email, utilisateur.telephone, Etudiant.id_etudiant 
                              FROM Etudiant 
                              JOIN utilisateur ON Etudiant.id_etudiant = utilisateur.id 
                              WHERE Etudiant.id_etudiant = :studentId';
                    $stmt = $db->prepare($query);
                    $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
                    $stmt->execute();
                    $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($etudiant) {
                        echo '<p><strong>Nom:</strong> ' . htmlspecialchars($etudiant['nom'], ENT_QUOTES) . '</p>';
                        echo '<p><strong>Prénom:</strong> ' . htmlspecialchars($etudiant['prenom'], ENT_QUOTES) . '</p>';
                        echo '<p><strong>Email:</strong> ' . htmlspecialchars($etudiant['email'], ENT_QUOTES) . '</p>';
                        echo '<p><strong>Téléphone:</strong> ' . htmlspecialchars($etudiant['telephone'], ENT_QUOTES) . '</p>';

                        $query = 'SELECT annee FROM stage WHERE id_etudiant = :studentId';
                        $stmt = $db->prepare($query);
                        $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
                        $stmt->execute();
                        $stage = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($stage) {
                            echo '<p>Année de stage: ' . htmlspecialchars($stage['annee'], ENT_QUOTES) . '</p>';
                        } else {
                            echo '<p>Aucun stage en cours.</p>';
                        }
                    } else {
                        echo '<p>Aucun étudiant trouvé avec cet ID.</p>';
                    }
                } else {
                    echo '<p>ID de l\'étudiant non spécifié.</p>';
                }
            } catch (PDOException $e) {
                echo 'Erreur : ' . $e->getMessage();
            }
            ?>
        </div>
    
        <section id="stage-history">
            <h2>Historique des Stages</h2>
            <div class="cards">
                <table>
                    <thead>
                        <tr>
                            <th>Stage ID</th>
                            <th>Année</th>
                            <th>Date de début</th>
                            <th>Date de fin</th>
                            <th>Mission</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        try {
                            $query = 'SELECT * FROM stage WHERE id_etudiant = :studentId';
                            $stmt = $db->prepare($query);
                            $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
                            $stmt->execute();
                            $stages = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            if ($stages) {
                                foreach ($stages as $stage) {
                                    echo '<tr>';
                                    echo '<td>' . htmlspecialchars($stage['id_stage'], ENT_QUOTES) . '</td>';
                                    echo '<td>' . htmlspecialchars($stage['annee'], ENT_QUOTES) . '</td>';
                                    echo '<td>' . htmlspecialchars($stage['date_debut'], ENT_QUOTES) . '</td>';
                                    echo '<td>' . htmlspecialchars($stage['date_fin'], ENT_QUOTES) . '</td>';
                                    echo '<td>' . htmlspecialchars($stage['mission'], ENT_QUOTES) . '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="5">Aucun historique de stage trouvé.</td></tr>';
                            }
                        } catch (PDOException $e) {
                            echo '<tr><td colspan="5">Erreur : ' . $e->getMessage() . '</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
        
        <section id="documents">
            <h2>Documents</h2>
            <div class="cards">
                <?php
                try {
                    $query = 'SELECT lien_document FROM action WHERE id_etudiant = :studentId';
                    $stmt = $db->prepare($query);
                    $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
                    $stmt->execute();
                    $documents = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if ($documents) {
                        foreach ($documents as $document) {
                            echo '<p><a href="' . htmlspecialchars($document['lien_document'], ENT_QUOTES) . '" target="_blank">Voir le document</a></p>';
                        }
                    } else {
                        echo '<p>Aucun document trouvé.</p>';
                    }
                } catch (PDOException $e) {
                    echo 'Erreur : ' . $e->getMessage();
                }
                ?>
            </div>
        </section>

        <!-- 
        <section id="communication">
            <h2>Communication</h2>
            <div class="cards">
                <?php
                try {
                    $query = 'SELECT * FROM Communication WHERE id_etudiant = :studentId';
                    $stmt = $db->prepare($query);
                    $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
                    $stmt->execute();
                    $communications = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if ($communications) {
                        foreach ($communications as $communication) {
                            echo '<p><strong>Communication ID:</strong> ' . htmlspecialchars($communication['Id_Communication'], ENT_QUOTES) . '</p>';
                            echo '<p><strong>Type:</strong> ' . htmlspecialchars($communication['type'], ENT_QUOTES) . '</p>';
                            echo '<p><strong>Message:</strong> ' . htmlspecialchars($communication['message'], ENT_QUOTES) . '</p>';
                            echo '<p><strong>Date:</strong> ' . htmlspecialchars($communication['date'], ENT_QUOTES) . '</p>';
                            echo '<hr>';
                        }
                    } else {
                        echo '<p>Aucune communication trouvée.</p>';
                    }
                } catch (PDOException $e) {
                    echo 'Erreur : ' . $e->getMessage();
                }
                ?>
            </div>
        </section>
        -->
    </section>
</body>
</html>