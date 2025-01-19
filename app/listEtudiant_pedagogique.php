<link rel="stylesheet" href="../CSS/listEtudiant_pedagogique.css">
<?php
echo "<h1>Liste des Étudiants</h1>";

$username = 'root';
$password = '';

try {
    // Établir la connexion à la base de données
    $bd = new PDO('mysql:host=localhost;dbname=sae3.0.0', $username, $password);
    $bd->query("SET NAMES 'utf8'");
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SQL corrigée : suppression de la colonne `validated`
    $requete = $bd->prepare('
        SELECT 
            u.id, 
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
                      AND a.Id_TypeAction = 5 -- Type de bordereau
                ) THEN "En attente"
                ELSE "Tâche en cours" -- Si une action existe, mais on ne vérifie plus `validated`
            END AS BordereauEtat
        FROM utilisateur u
        JOIN inscription i ON i.Id_Etudiant = u.Id
        JOIN departement d ON i.Id_Departement = d.Id_Departement
    ');

    $requete->execute();
    $tab = $requete->fetchAll(PDO::FETCH_ASSOC);

    // Affichage des résultats
    foreach ($tab as $info) {
        // Déterminer la couleur et le texte de l'état
        $etatClasse = '';
        $etatTexte = '';
        switch ($info["BordereauEtat"]) {
            case "En attente":
                $etatClasse = 'etat-gris'; // Couleur grise
                $etatTexte = 'En attente';
                break;
            case "Tâche en cours":
                $etatClasse = 'etat-orange'; // Couleur orange
                $etatTexte = 'Tâche en cours';
                break;
            case "Tâche complète":
                $etatClasse = 'etat-vert'; // Couleur verte
                $etatTexte = 'Tâche complète';
                break;
        }

        // Rendre le div cliquable pour charger DocumentEtudiant.php
        echo '<div class="listEtudiant" id="etudiant-' . $info["id"] . '" 
              onclick="loadDocumentEtudiant(' . $info["id"] . ', \'' . $info["nom"] . '\', \'' . $info["prenom"] . '\')">
            <p>' . strtoupper($info["nom"]) . ' ' . $info["prenom"] . '</p>
            <p>BUT ' . $info["Libelle"] . '</p>
            <p>État : <span class="' . $etatClasse . '">' . $etatTexte . '</span></p>
        </div>';
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
