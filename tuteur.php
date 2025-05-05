<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Tuteurs - Responsable de Stage</title>
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
        <h1 id="titre">Gestion des Tuteurs</h1>
        <div class="cards">
            <section id="add-tuteur-pedagogique">
                <h2>Ajouter un Tuteur Pédagogique</h2>
                <form action="tuteur.php" method="post">
                    <label for="enseignant">Sélectionner un enseignant :</label>
                    <select id="enseignant" name="enseignant">
                        <?php
                        require_once(__DIR__ . '/../config/database.php'); // Inclure database.php
                        try {
                            $db = Database::getConnexion(); // Utiliser la connexion centralisée

                            $query = 'SELECT Utilisateur.Id, Utilisateur.nom, Utilisateur.prenom FROM Enseignant JOIN Utilisateur ON Enseignant.Id_Enseignant = Utilisateur.Id';
                            $stmt = $db->query($query);
                            $enseignants = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($enseignants as $enseignant) {
                                echo '<option value="' . htmlspecialchars($enseignant['Id'], ENT_QUOTES) . '">' . htmlspecialchars($enseignant['nom'], ENT_QUOTES) . ' ' . htmlspecialchars($enseignant['prenom'], ENT_QUOTES) . '</option>';
                            }
                        } catch (PDOException $e) {
                            echo 'Erreur : ' . $e->getMessage();
                        }
                        ?>
                    </select><br>
                    <button type="submit" name="add_tuteur_pedagogique">Ajouter le Tuteur Pédagogique</button>
                </form>
            </section>

            <section id="add-tuteur-entreprise">
                <h2>Ajouter un Tuteur Entreprise</h2>
                <form action="tuteur.php" method="post">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" required><br>

                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" required><br>

                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" required><br>

                    <label for="telephone">Téléphone :</label>
                    <input type="text" id="telephone" name="telephone" required><br>

                    <label for="login">Login :</label>
                    <input type="text" id="login" name="login" required><br>

                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" required><br>

                    <label for="entreprise">Sélectionner une entreprise :</label>
                    <select id="entreprise" name="entreprise">
                        <?php
                        try {
                            $db = Database::getConnexion(); // Utiliser la connexion centralisée

                            $query = 'SELECT Id_Entreprise FROM Entreprise';
                            $stmt = $db->query($query);
                            $entreprises = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($entreprises as $entreprise) {
                                echo '<option value="' . htmlspecialchars($entreprise['Id_Entreprise'], ENT_QUOTES) . '">' . htmlspecialchars($entreprise['Id_Entreprise'], ENT_QUOTES) . '</option>';
                            }
                        } catch (PDOException $e) {
                            echo 'Erreur : ' . $e->getMessage();
                        }
                        ?>
                    </select><br>
                    <button type="submit" name="add_tuteur_entreprise">Ajouter le Tuteur Entreprise</button>
                </form>
            </section>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['add_tuteur_pedagogique'])) {
                    $enseignantId = $_POST['enseignant'];

                    try {
                        // Update the role of the selected enseignant to 'pedagogique'
                        $query = 'UPDATE Utilisateur SET role = "pedagogique" WHERE Id = :enseignantId';
                        $stmt = $db->prepare($query);
                        $stmt->bindParam(':enseignantId', $enseignantId, PDO::PARAM_INT);
                        $stmt->execute();

                        echo '<p>Le tuteur pédagogique a été ajouté avec succès.</p>';
                    } catch (PDOException $e) {
                        echo 'Erreur : ' . $e->getMessage();
                    }
                } elseif (isset($_POST['add_tuteur_entreprise'])) {
                    $nom = $_POST['nom'];
                    $prenom = $_POST['prenom'];
                    $email = $_POST['email'];
                    $telephone = $_POST['telephone'];
                    $login = $_POST['login'];
                    $motdepasse = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $entrepriseId = $_POST['entreprise'];

                    try {
                        // Ensure the login is unique
                        $originalLogin = $login;
                        $i = 1;
                        while (true) {
                            $query = 'SELECT COUNT(*) FROM Utilisateur WHERE login = :login';
                            $stmt = $db->prepare($query);
                            $stmt->bindParam(':login', $login, PDO::PARAM_STR);
                            $stmt->execute();
                            if ($stmt->fetchColumn() == 0) {
                                break;
                            }
                            $login = $originalLogin . $i;
                            $i++;
                        }

                        // Insert the new utilisateur with role 'tuteur'
                        $query = 'INSERT INTO Utilisateur (nom, prenom, email, telephone, role, login, motdepasse) VALUES (:nom, :prenom, :email, :telephone, "tuteur", :login, :motdepasse)';
                        $stmt = $db->prepare($query);
                        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
                        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                        $stmt->bindParam(':telephone', $telephone, PDO::PARAM_STR);
                        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
                        $stmt->bindParam(':motdepasse', $motdepasse, PDO::PARAM_STR);
                        $stmt->execute();

                        // Get the last inserted Id from Utilisateur
                        $lastUserId = $db->lastInsertId();

                        // Insert the new tuteur entreprise
                        $query = 'INSERT INTO Tuteur_Entreprise (Id_Tuteur_Entreprise, Id_Entreprise) VALUES (:lastUserId, :entrepriseId)';
                        $stmt = $db->prepare($query);
                        $stmt->bindParam(':lastUserId', $lastUserId, PDO::PARAM_INT);
                        $stmt->bindParam(':entrepriseId', $entrepriseId, PDO::PARAM_INT);
                        $stmt->execute();

                        echo '<p>Le tuteur entreprise a été ajouté avec succès.</p>';
                    } catch (PDOException $e) {
                        echo 'Erreur : ' . $e->getMessage();
                    }
                }
            }
            ?>
        </div>
    </section>
</body>
</html>