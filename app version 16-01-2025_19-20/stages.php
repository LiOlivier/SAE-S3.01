<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des stages - Responsable de Stage</title>
    <link rel="stylesheet" href="../CSS/aside.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/card.css">
    <link rel="stylesheet" href="../CSS/TBD.css">
    <link rel="stylesheet" href="../CSS/tableau.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
        integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
</head>
<body class="body">
    <?php 
        require_once(__DIR__ . "/component/header.php");
        require_once(__DIR__ . "/component/aside.php"); 
    ?>

    <section id="one">
        <h1 id="titre">Liste des stages</h1>
        <div class="cards">
            <table>
                <thead>
                    <tr>
                        <th>Numero étudiant</th>
                        <th>Semestre</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Entreprise Ville</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require "dbdata.php"; // Include your database credentials
                    try {
                        $db = new PDO($dsn, $login, $mdp);
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



                        $query = 'SELECT * FROM Stage 
                                  JOIN Utilisateur ON Stage.Id_Etudiant = Utilisateur.Id
                                  JOIN Tuteur_Entreprise ON Stage.Id_Tuteur_Entreprise = Tuteur_Entreprise.Id_Tuteur_Entreprise 
                                  JOIN Entreprise ON Tuteur_Entreprise.Id_Entreprise = Entreprise.Id_Entreprise';

                        $stmt = $db->query($query);
                        $stages = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                        
                        
                        if (empty($stages)) {
                            echo '<tr><td colspan="6">Aucun stage trouvé.</td></tr>';
                        } else {
                            foreach ($stages as $stage): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($stage['Id_Etudiant'], ENT_QUOTES); ?></td>
                                    <td><?php echo htmlspecialchars($stage['numSemestre'], ENT_QUOTES); ?></td>
                                    <td><?php echo htmlspecialchars($stage['date_debut'], ENT_QUOTES); ?></td>
                                    <td><?php echo htmlspecialchars($stage['date_fin'], ENT_QUOTES); ?></td>
                                    <td><?php echo htmlspecialchars($stage['ville'], ENT_QUOTES); ?></td>
                                </tr>
                            <?php endforeach;
                        }
                    } catch (PDOException $e) {
                        echo 'Erreur : ' . $e->getMessage();
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>
<script src="../JS/notif.js"></script>