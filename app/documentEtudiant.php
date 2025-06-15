<link rel="stylesheet" href="../CSS/documentEtudiant.css">
<button id="backButton" onclick="goBack()">Retour</button>

<?php
session_start();
require_once "../config/database.php";
$bd = Database::getConnexion('mysql');

if (isset($_GET['id'])) {
    $studentId = $_GET['id'];

    try {
        $bd->query("SET NAMES 'utf8'");

        $requete = $bd->prepare('
                SELECT u.nom,
                    u.prenom
                        FROM utilisateur as u
                        JOIN (SELECT * FROM utilisateur u
                        JOIN stage s ON u.id = s.Id_Etudiant
                        WHERE u.Id = 5) AS e
                        ON u.id =e.`Id_Enseignant_1`
        ');
        
        
        $requete->execute();
        $dataUser = $requete->fetch(PDO::FETCH_ASSOC);

        $requete = $bd->prepare('
                SELECT 
                u.id, 
                u.nom, 
                u.prenom, 
                u.email, 
                u.telephone,
                d.Libelle,
                s.Id_Enseignant_1 as id_tuteur_pedagogique,
                s.Id_Stage as id_stage,
                CASE 
                    WHEN NOT EXISTS (
                        SELECT 1 
                        FROM action a 
                        WHERE a.Id_Etudiant = u.Id 
<<<<<<< HEAD
                        AND a.Id_TypeAction = 7 -- Type de bordereau
=======
                        AND a.id_type_action = 7 -- Type de bordereau
>>>>>>> origin/main
                    ) THEN "En attente"
                    ELSE "Tâche complète"
                END AS BordereauEtat,
                CASE 
                    WHEN NOT EXISTS (
                        SELECT 1 
                        FROM action a 
                        WHERE a.Id_Etudiant = u.Id 
<<<<<<< HEAD
                        AND a.Id_TypeAction = 9 -- Type de convention
=======
                        AND a.id_type_action = 9 -- Type de convention
>>>>>>> origin/main
                    ) THEN "En attente"
                    ELSE "Tâche complète"
                END AS ConventionEtat,
                CASE 
                    WHEN NOT EXISTS (
                        SELECT 1 
                        FROM action a 
                        WHERE a.Id_Etudiant = u.Id 
<<<<<<< HEAD
                        AND a.Id_TypeAction = 6 -- Type de rapport
=======
                        AND a.id_type_action = 6 -- Type de rapport
>>>>>>> origin/main
                    ) THEN "En attente"
                    ELSE "Tâche complète"
                END AS RapportEtat
            FROM utilisateur u
            JOIN stage s ON u.id = s.Id_Etudiant
            JOIN inscription i ON i.Id_Etudiant = u.Id
            JOIN departement d ON i.Id_Departement = d.Id_Departement
            WHERE u.Id = :studentId
        ');
        $requete->bindParam(':studentId', $studentId, PDO::PARAM_INT);
        
        $requete->execute();

        $student = $requete->fetch(PDO::FETCH_ASSOC);
        $requete->bindParam(':stageId', $student['id_stage'], PDO::PARAM_INT);
        if ($student) {
            echo "<div id='bloc-etudiant'>
                    <h1>" . strtoupper($student['nom']) . " " . $student['prenom'] . " - BUT " . $student['Libelle'] . "</h1>
                    <h2>".$student["email"]." - ".$student["telephone"]."</h2>
                  </div>";

            echo '<div class="document-section">
                    <h3>Bordereau de stage</h3>
                    <form action="telechargement_pedagogique.php" method="POST">
                        <input type="hidden" name="studentId" value="' . $studentId . '">
                        <input type="hidden" name="documentType" value="bordereau">
                        <input type="hidden" name="nomDoc" value="bordereau-'.$studentId.'-'.$student['nom'].'_'.$student['prenom'].'.pdf">
                        ';
                        if ($student['BordereauEtat'] == 'En attente'){
                            echo '
                            <p>État actuel : <span class="bordereau-etat" style="color:red">' . $student['BordereauEtat'] . '</span></p>
                            <button type="submit" name="action" value="telecharger" disabled="true" style="background-color:grey;color:black;">Télécharger</button>';
                        }
                        else{
                            echo '
                            <p>État actuel : <span class="bordereau-etat" style="color:green">' . $student['BordereauEtat'] . '</span></p>
                            <button type="submit" name="action" value="telecharger">Télécharger</button>';
                        }
                        echo '
                    </form>
                  </div>';
                  
            echo '<div class="document-section">
                    <h3>Convention de stage</h3>
                    

                    <!-- Télécharger le document -->
                    <form action="telechargement_pedagogique.php" method="POST">
                        <input type="hidden" name="studentId" value="'.$studentId.'">
                        <input type="hidden" name="documentType" value="convention">
                        <input type="hidden" name="nomDoc" value="Convention-'.$studentId.'-'.$student['nom'].'_'.$student['prenom'].'.pdf">
                        ';
                        
                        if ($student['ConventionEtat'] == 'En attente'){
                            echo '
                            <p>État actuel : <span class="convention-etat" style="color:red">'.$student["ConventionEtat"].'</span></p>
                            <button type="submit" name="action" value="telecharger" disabled="true" style="background-color:grey;color:black;">Télécharger</button>';
                        }
                        else{
                            echo '  
                            <p>État actuel : <span class="convention-etat" style="color:green">'.$student["ConventionEtat"].'</span></p>
                            <button type="submit" name="action" value="telecharger" >Télécharger</button>';
                        }
                        echo '
                    </form>

                    <!-- Importer et confirmer le document -->
                    <form action="./component/upload_handler_pedagogique.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="studentId" value="'.$studentId.'">
                        <input type="hidden" name="stageId" value="'.$student['id_stage'].'">
                        <input type="hidden" name="NomUser" value="'.$dataUser["nom"].'">
                        <input type="hidden" name="prenomUser" value="'.$dataUser["prenom"].'">
                        <input type="hidden" name="documentType" value="convention">
                        <label for="document">Importer votre convention :</label><br>
                        <input type="file" name="document" required><br><br>
                        <button type="submit" name="action" value="confirmer">Confirmer</button>
                    </form>
                </div>
                ';

            echo '<div class="document-section">
                    <h3>Rapport de stage</h3>
                    
                    <form action="telechargement_pedagogique.php" method="POST">
                        <input type="hidden" name="studentId" value="<?php echo $studentId; ?>">
                        <input type="hidden" name="nomDoc" value="Rapport-'.$studentId.'-'.$student['nom'].'_'.$student['prenom'].'.pdf">
                    ';
                        if ($student['RapportEtat'] == 'En attente'){
                            echo '
                            <p>État actuel : <span class="rapport-etat" style="color: red">' . $student['RapportEtat'] . '</span></p>
                            <button type="submit" name="action" value="telecharger" disabled="true" style="background-color:grey;color:black;">Télécharger</button>';
                        }
                        else{
                            echo '
                            <p>État actuel : <span class="rapport-etat" style="color: green">' . $student['RapportEtat'] . '</span></p>
                            <button type="submit" name="action" value="telecharger" >Télécharger</button>';
                        }
                        echo '
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
