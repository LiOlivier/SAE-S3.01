<link rel="stylesheet" href="../CSS/listEtudiant_pedagogique.css">
<?php
echo "<h1>Liste des Étudiants</h1>";
$username = 'root';
$password = '';


try {
    require_once "../config/database.php";
    $bd = Database::getConnexion('mysql');
    $bd->query("SET NAMES 'utf8'");
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


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
                      AND a.id_type_action = 7 -- Type de bordereau
                ) THEN "En attente"
                ELSE "Tâche complète"
            END AS BordereauEtat,
            CASE 
                WHEN NOT EXISTS (
                    SELECT 1 
                    FROM action a 
                    WHERE a.Id_Etudiant = u.Id 
                      AND a.id_type_action = 9 -- Type de convention
                ) THEN "En attente"
                ELSE "Tâche complète"
            END AS ConventionEtat
        FROM utilisateur u
        JOIN stage s ON u.id = s.Id_Etudiant
        JOIN inscription i ON i.Id_Etudiant = u.Id
        JOIN departement d ON i.Id_Departement = d.Id_Departement
        WHERE Id_Enseignant_1 ='.$utilisateurId
    );

    $requete->execute();
    $tab = $requete->fetchAll(PDO::FETCH_ASSOC);


    foreach ($tab as $info) {

        $etatClasse = '';
        $etatTexte = '';
        echo '<div class="listEtudiant" id="etudiant-' . $info["id"] . '" 
              onclick="loadDocumentEtudiant(' . $info["id"] . ', \'' . $info["nom"] . '\', \'' . $info["prenom"] . '\')">
            <p>' . strtoupper($info["nom"]) . ' ' . $info["prenom"] . '</p>
            <p>BUT ' . $info["Libelle"] . '</p>
            ';
        switch ($info["BordereauEtat"]) {
            case "En attente":
                $etatClasse = 'etat-gris';
                $etatTexte = 'En attente';
                break;
            case "Tâche complète":
                $etatClasse = 'etat-vert';
                $etatTexte = 'Tâche complète';
                break;
            echo '<p>État convention : <span class="' . $etatClasse . '">' . $etatTexte . '</span></p>';
        }


        echo '<p>État bordereau : <span class="' . $etatClasse . '">' . $etatTexte . '</span></p>';
        switch ($info["ConventionEtat"]) {
            case "En attente":
                $etatClasse = 'etat-gris'; 
                $etatTexte = 'En attente';
                break;
            case "Tâche complète":
                $etatClasse = 'etat-vert'; 
                $etatTexte = 'Tâche complète';
                break;
        }
        echo '<p>État convention : <span class="' . $etatClasse . '">' . $etatTexte . '</span></p>';
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
