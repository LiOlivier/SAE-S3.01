<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignation des Tuteurs - Responsable de Stage</title>
    <link rel="stylesheet" href="../CSS/aside.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/card.css">
    <link rel="stylesheet" href="../CSS/TBD.css">
    <link rel="stylesheet" href="../CSS/tableau.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
        integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
</head>

<?php require_once(__DIR__ . "/component/header.php");
require_once(__DIR__ . "/component/aside.php"); ?>

<body class="body">
    <section id="one">
        <main>
            <section id="assign-tuteur">
                <h2>Assignation des Tuteurs</h2>
                <form action="assign-tuteur.php" method="post">
                    <label for="student">Sélectionner un étudiant :</label>
                    <select id="student" name="student">
                        <?php
                        require "dbdata.php"; // Include your database credentials
                        try {
                            $db = new PDO($dsn, $login, $mdp);
                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $query = 'SELECT Id_Etudiant, nom, prenom FROM Etudiant JOIN Utilisateur ON Etudiant.Id_Etudiant = Utilisateur.Id';
                            $stmt = $db->query($query);
                            $etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($etudiants as $etudiant) {
                                echo '<option value="' . htmlspecialchars($etudiant['Id_Etudiant']) . '">' . htmlspecialchars($etudiant['nom']) . ' ' . htmlspecialchars($etudiant['prenom']) . '</option>';
                            }
                        } catch (PDOException $e) {
                            echo 'Erreur : ' . $e->getMessage();
                        }
                        ?>
                    </select>

                    <label for="tuteur_pedagogique">Sélectionner un tuteur pédagogique :</label>
                    <select id="tuteur_pedagogique" name="tuteur_pedagogique">
                        <?php
                        try {
                            $query = 'SELECT Id_Enseignant, nom, prenom FROM Enseignant JOIN Utilisateur ON Enseignant.Id_Enseignant = Utilisateur.Id';
                            $stmt = $db->query($query);
                            $enseignants = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($enseignants as $enseignant) {
                                echo '<option value="' . htmlspecialchars($enseignant['Id_Enseignant']) . '">' . htmlspecialchars($enseignant['nom']) . ' ' . htmlspecialchars($enseignant['prenom']) . '</option>';
                            }
                        } catch (PDOException $e) {
                            echo 'Erreur : ' . $e->getMessage();
                        }
                        ?>
                    </select>

                    <label for="tuteur_entreprise">Sélectionner un tuteur entreprise :</label>
                    <select id="tuteur_entreprise" name="tuteur_entreprise">
                        <?php
                        try {
                            $query = 'SELECT Id_Tuteur_Entreprise, nom, prenom FROM Tuteur_Entreprise JOIN Utilisateur ON Tuteur_Entreprise.Id_Tuteur_Entreprise = Utilisateur.Id';
                            $stmt = $db->query($query);
                            $tuteurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($tuteurs as $tuteur) {
                                echo '<option value="' . htmlspecialchars($tuteur['Id_Tuteur_Entreprise']) . '">' . htmlspecialchars($tuteur['nom']) . ' ' . htmlspecialchars($tuteur['prenom']) . '</option>';
                            }
                        } catch (PDOException $e) {
                            echo 'Erreur : ' . $e->getMessage();
                        }
                        ?>
                    </select>

                    <button type="submit">Assigner</button>
                </form>
            </section>
        </main>
    </section>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $studentId = $_POST['student'];
        $tuteurPedagogiqueId = $_POST['tuteur_pedagogique'];
        $tuteurEntrepriseId = $_POST['tuteur_entreprise'];

        try {
            $query = 'UPDATE Stage SET Id_Enseignant_1 = :tuteurPedagogiqueId, Id_Tuteur_Entreprise = :tuteurEntrepriseId WHERE Id_Etudiant = :studentId';
            $stmt = $db->prepare($query);
            $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
            $stmt->bindParam(':tuteurPedagogiqueId', $tuteurPedagogiqueId, PDO::PARAM_INT);
            $stmt->bindParam(':tuteurEntrepriseId', $tuteurEntrepriseId, PDO::PARAM_INT);
            $stmt->execute();

            echo '<p>Les tuteurs ont été assignés avec succès.</p>';
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }
    ?>
</body>
</html>