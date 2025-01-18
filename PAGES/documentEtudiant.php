<link rel="stylesheet" href="../CSS/documentEtudiant.css">
<button id="backButton" onclick="goBack()">Retour</button>

<?php
if (isset($_GET['id'])) {
    $studentId = $_GET['id']; // Récupère l'ID étudiant dans l'URL

    // Connexion à la base de données
    $servername = 'localhost';
    $username = 'root';
    $password = '';

    try {
        $bd = new PDO('mysql:host=localhost;dbname=sae3.0.0', $username, $password);
        $bd->query("SET NAMES 'utf8'");
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparation de la requête pour les détails de l'étudiant
        $requete = $bd->prepare('
            SELECT 
                u.nom, 
                u.prenom, 
                u.email, 
                u.telephone, 
                d.Libelle,
                CASE 
                    WHEN NOT EXISTS (
                        SELECT 1 
                        FROM action a 
                        WHERE a.Id_Etudiant = u.Id 
                          AND a.Id_TypeAction = 5
                    ) THEN "En attente"
                    ELSE "Tâche en cours"
                END AS BordereauEtat
            FROM utilisateur u
            JOIN inscription i ON i.Id_Etudiant = u.Id
            JOIN departement d ON i.Id_Departement = d.Id_Departement
            WHERE u.Id = :studentId
        ');
        $requete->bindParam(':studentId', $studentId, PDO::PARAM_INT);
        $requete->execute();

        $student = $requete->fetch(PDO::FETCH_ASSOC);

        if ($student) {
            echo "<div id='bloc-etudiant'>
                    <h1>" . strtoupper(htmlspecialchars($student['nom'])) . " " . htmlspecialchars($student['prenom']) . " - BUT " . htmlspecialchars($student['Libelle']) . "</h1>
                  </div>";

            // Section bordereau
            echo '<div class="document-section">
                    <h3>Bordereau de stage</h3>
                    <p>État actuel : <span class="bordereau-etat">' . htmlspecialchars($student['BordereauEtat']) . '</span></p>
                    <form action="telechargement.php" method="POST">
                        <input type="hidden" name="studentId" value="' . htmlspecialchars($studentId) . '">
                        <input type="hidden" name="documentType" value="bordereau">
                        <button type="submit" name="action" value="telecharger">Télécharger</button>
                    </form>
                  </div>';
            echo '<div class="document-section">
                    <h3>Convention de stage</h3>
                    <p>État actuel : <span class="bordereau-etat">' . htmlspecialchars($student['BordereauEtat']) . '</span></p>
                    <form action="telechargement.php" method="POST">
                      <input type="hidden" name="studentId" value="' . htmlspecialchars($studentId) . '">
                      <input type="hidden" name="documentType" value="bordereau">

                      <label for="document">Importer votre convention :</label><br>
                      <input type="file" name="document"><br><br>
                      <button type="submit" name="action" value="telecharger">Télécharger</button>
                      <button type="submit" name="action" value="confirmer">Confirmer</button>
                  </form>
                </div>';
            echo '<div class="document-section">
                    <h3>Rapport de stage</h3>
                    <p>État actuel : <span class="bordereau-etat">' . htmlspecialchars($student['BordereauEtat']) . '</span></p>
                    <form action="telechargement.php" method="POST">
                        <input type="hidden" name="studentId" value="' . htmlspecialchars($studentId) . '">
                        <input type="hidden" name="documentType" value="bordereau">
                    <button type="submit" name="action" value="telecharger">Télécharger</button>
                </form>
            </div>';
        } else {
            echo "<p>Les détails de l'étudiant sont introuvables.</p>";
        }
    } catch (PDOException $e) {
        echo "<p>Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
    }
} else {
    echo "<p>ID de l'étudiant non fourni.</p>";
}
?>
