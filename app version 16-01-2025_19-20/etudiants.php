<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Etudiants - Responsable de Stage</title>
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
        <h1 id="titre">Liste des Etudiants</h1>
        <div class="cards">
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>mail</th>
                        <th>telephone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require "dbdata.php"; // Include your database credentials
                    try {
                        $db = new PDO($dsn, $login, $mdp);
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $query = 'SELECT * FROM Etudiant JOIN Utilisateur ON Etudiant.Id_Etudiant = Utilisateur.Id';

                        $stmt = $db->query($query);
                        $etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (empty($etudiants)) {
                            echo '<tr><td colspan="4">Aucun étudiant trouvé.</td></tr>';
                        } else {
                            foreach ($etudiants as $etudiant): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($etudiant['nom'], ENT_QUOTES); ?></td>
                                    <td><?php echo htmlspecialchars($etudiant['prenom'], ENT_QUOTES); ?></td>
                                    <td><?php echo htmlspecialchars($etudiant['email'], ENT_QUOTES); ?></td>
                                    <td><?php echo htmlspecialchars($etudiant['telephone'], ENT_QUOTES); ?></td>
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