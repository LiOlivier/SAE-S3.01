<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un utilisateur</title>
    <link rel="stylesheet" href="../CSS/aside.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/form.css">
    <link rel="stylesheet" href="../CSS/t.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
        integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        section {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 2rem;
            color: #333;
        }

        form {
            width: 100%;
            max-width: 600px;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        label {
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        input,
        select,
        button {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #4caf50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
        }

        button {
            background-color: #003366;
            color: white;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color:rgb(32, 14, 225);
        }

        .alert {
            margin-top: 10px;
            padding: 15px;
            font-size: 1rem;
            color: white;
            border-radius: 5px;
        }

        .alert.success {
            background-color:rgb(44, 11, 207);
        }

        .alert.error {
            background-color: #f44336;
        }
    </style>
</head>

<body>
    <?php
    require_once('./controller/sessionController.php');
    require_once(__DIR__ . "/component/header.php");
    require_once(__DIR__ . "/component/aside.php");
    ?>

    <section>
        <h1>Ajouter un utilisateur</h1>
        <form action="" method="POST">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" placeholder="Entrez le nom" required>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" placeholder="Entrez le prénom" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" placeholder="exemple@email.com" required>

            <label for="telephone">Téléphone :</label>
            <input type="text" id="telephone" name="telephone" placeholder="06XXXXXXXX" required>

            <label for="login">Login :</label>
            <input type="text" id="login" name="login" placeholder="Choisissez un identifiant" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" placeholder="Créez un mot de passe" required>

            <label for="role">Rôle :</label>
            <select id="role" name="role" required>
                <option value="enseignant">Enseignant</option>
                <option value="tuteur_pédagogique">Tuteur Pédagogique</option>
                <option value="secrétaire">Secrétaire</option>
                <option value="tuteur_stage">Tuteur de Stage</option>
                <option value="tuteur_entreprise">Tuteur Entreprise</option>
            </select>

            <div id="entreprise-section" style="display: none;">
                <label for="entreprise">Entreprise (si Tuteur Entreprise) :</label>
                <select id="entreprise" name="entreprise">
                    <option value="">Aucune</option>
                    <?php
                    try {
                        //$db_dev = array("host" => "localhost", "port" => "3306", "dbname" => "sorbonne2", "login" => "root", "password" => "root");
                        $pdo = new PDO('mysql:host=localhost;dbname=sorbonne2;charset=utf8', 'root', '');
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $query = "SELECT Id_Entreprise, ville FROM Entreprise";
                        $stmt = $pdo->query($query);
                        $entreprises = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($entreprises as $entreprise) {
                            echo '<option value="' . htmlspecialchars($entreprise['Id_Entreprise'], ENT_QUOTES) . '">' . htmlspecialchars($entreprise['ville'], ENT_QUOTES) . '</option>';
                        }
                    } catch (PDOException $e) {
                        echo "Erreur : " . $e->getMessage();
                    }
                    ?>
                </select>
            </div>

            <button type="submit" name="submit">Ajouter l'utilisateur</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $telephone = $_POST['telephone'];
            $login = $_POST['login'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $role = $_POST['role'];
            $entrepriseId = $_POST['entreprise'] ?? null;

            try {
                $pdo = new PDO('mysql:host=localhost;dbname=sae3.01;charset=utf8', 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Vérifier si le login est unique
                $query = "SELECT COUNT(*) FROM Utilisateur WHERE login = :login";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':login', $login, PDO::PARAM_STR);
                $stmt->execute();
                if ($stmt->fetchColumn() > 0) {
                    echo "<div class='alert error'>Erreur : Le login est déjà utilisé.</div>";
                } else {
                    // Ajouter l'utilisateur dans la table Utilisateur
                    $query = "INSERT INTO Utilisateur (nom, prenom, email, telephone, role, login, password) 
                              VALUES (:nom, :prenom, :email, :telephone, :role, :login, :password)";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
                    $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                    $stmt->bindParam(':telephone', $telephone, PDO::PARAM_STR);
                    $stmt->bindParam(':role', $role, PDO::PARAM_STR);
                    $stmt->bindParam(':login', $login, PDO::PARAM_STR);
                    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                    $stmt->execute();

                    // Si le rôle est "tuteur_entreprise", ajouter dans la table Tuteur_Entreprise
                    if ($role === 'tuteur_entreprise' && !empty($entrepriseId)) {
                        $lastUserId = $pdo->lastInsertId();
                        $query = "INSERT INTO Tuteur_Entreprise (Id_Tuteur_Entreprise, Id_Entreprise) VALUES (:userId, :entrepriseId)";
                        $stmt = $pdo->prepare($query);
                        $stmt->bindParam(':userId', $lastUserId, PDO::PARAM_INT);
                        $stmt->bindParam(':entrepriseId', $entrepriseId, PDO::PARAM_INT);
                        $stmt->execute();
                    }

                    echo "<div class='alert success'>Utilisateur ajouté avec succès.</div>";
                }
            } catch (PDOException $e) {
                echo "<div class='alert error'>Erreur : " . $e->getMessage() . "</div>";
            }
        }
        ?>
    </section>

    <script>
        const roleSelect = document.getElementById('role');
        const entrepriseSection = document.getElementById('entreprise-section');

        roleSelect.addEventListener('change', () => {
            if (roleSelect.value === 'tuteur_entreprise') {
                entrepriseSection.style.display = 'block';
            } else {
                entrepriseSection.style.display = 'none';
            }
        });
    </script>
</body>

</html>
