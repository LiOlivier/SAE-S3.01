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
    overflow-x: hidden;
}

/* Container global */
.layout {
    display: flex;
    width: 100%;
    max-width: 100vw;
    min-height: 100vh;
}

/* Aside */
aside {
    width: 250px;
    flex-shrink: 0;
    background-color: #fff;
}

/* Section principale */
section {
    margin-left:250px;
    flex: 1;
    padding: 2rem 2rem;
    box-sizing: border-box;
    min-width: 0;
}

/* Titre */
h1 {
    margin-top: 100px;
    margin-bottom: 20px;
    font-size: 2rem;
    color: #333;
    text-align: center;
}

/* Formulaire */
form {
    max-width: 800px;
    width: 100%;
    margin: 0 auto;
    background-color: #fff;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    box-sizing: border-box;
}

/* Éléments du formulaire */
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
    box-sizing: border-box;
}

input:focus,
select:focus {
    outline: none;
    border-color: #003366;
    box-shadow: 0 0 5px rgba(0, 51, 102, 0.5);
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
    background-color: rgb(32, 14, 225);
}

/* Alertes */
.alert {
    margin-top: 10px;
    padding: 15px;
    font-size: 1rem;
    color: white;
    border-radius: 5px;
}

.alert.success {
    background-color: rgb(44, 11, 207);
}

.alert.error {
    background-color: #f44336;
}

/* Responsive mobile */
@media (max-width: 768px) {
    .layout {
        flex-direction: column;
    }

    aside {
        width: 100%;
        position: relative;
    }

    section {
        padding: 1.5rem;
    }

    form {
        padding: 25px;
        max-width: 95%;
    }
}


    </style>
    <?php
    require('./controller/sessionController.php');
    require_once 'component/aside.php';
    require_once 'component/header.php';
    require_once '../config/database.php';
    $pdo = Database::getConnexion('mysql');
    ?>
    
</head>
<body>
    <div class="layout">
        <?php require_once 'component/aside.php'; ?>
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
                <input type="text" id="telephone" name="telephone" placeholder="+33XXXXXXXX" required>

                <label for="login">Login :</label>
                <input type="text" id="login" name="login" placeholder="Choisissez un identifiant" required>

                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" placeholder="Créez un mot de passe" required>

                <label for="role">Rôle :</label>
                <select id="role" name="role" required>
                    <option value="etudiant">Étudiant</option>
                    <option value="enseignant">Enseignant</option>
                    <option value="secretaire">Secrétaire</option>
                    <option value="tuteur_entreprise">Tuteur Entreprise</option>
                    <option value="administrateur">Administrateur</option>
                </select>

                <div id="etudiant-section" style="display: none;">
                    <label for="departement">Département :</label>
                    <select id="departement" name="departement">
                        <option value="1">Informatique</option>
                        <option value="2">GEA</option>
                        <option value="3">RT</option>
                        <option value="4">SD</option>
                    </select>

                    <label for="semestre">Semestre :</label>
                    <select id="semestre" name="semestre">
                        <option value="1">Semestre 1</option>
                        <option value="2">Semestre 2</option>
                        <option value="3">Semestre 3</option>
                        <option value="4">Semestre 4</option>
                        <option value="5">Semestre 5</option>
                        <option value="6">Semestre 6</option>
                    </select>
                </div>

                <div id="entreprise-section" style="display: none;">
                    <label for="entreprise">Entreprise (si Tuteur Entreprise) :</label>
                    <select id="entreprise" name="entreprise">
                        <option value="">Aucune</option>
                        <?php
                        try {
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $query = "SELECT Id_Entreprise, ville FROM entreprise";
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
            $departement = $_POST['departement'] ?? null;
            $semestre = $_POST['semestre'] ?? null;
            $entrepriseId = $_POST['entreprise'] ?? null;

            $stmt = $pdo->prepare("SELECT COUNT(*) FROM utilisateur WHERE login = :login");
            $stmt->bindParam(':login', $login);
            $stmt->execute();
            if ($stmt->fetchColumn() > 0) {
                echo "<div class='alert error'>Ce login est déjà utilisé. Choisissez un autre identifiant.</div>";
                exit;
            }

            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $query = "INSERT INTO utilisateur (nom, prenom, email, telephone, login, password, role) 
                        VALUES (:nom, :prenom, :email, :telephone, :login, :password, :role)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':nom', $nom);
                $stmt->bindParam(':prenom', $prenom);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':telephone', $telephone);
                $stmt->bindParam(':login', $login);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':role', $role);
                $stmt->execute();

                $lastUserId = $pdo->lastInsertId();

                if ($role === 'etudiant') {
                    $stmt = $pdo->prepare("INSERT INTO etudiant (id_Etudiant) VALUES (:id)");
                    $stmt->bindParam(':id', $lastUserId);
                    $stmt->execute();

                    try {
                        $stmt = $pdo->prepare("INSERT INTO inscription (annee, Id_Departement, num_Semestre, Id_Etudiant) 
                                            VALUES (YEAR(CURDATE()), :departement, :semestre, :id)");
                        $stmt->bindParam(':departement', $departement);
                        $stmt->bindParam(':semestre', $semestre);
                        $stmt->bindParam(':id', $lastUserId);
                        $stmt->execute();
                    } catch (PDOException $e) {
                        // Ne rien afficher, erreur ignorée volontairement
                    }
                } elseif ($role === 'enseignant') {
                    $stmt = $pdo->prepare("INSERT INTO enseignant (Id_Enseignant) VALUES (:id)");
                    $stmt->bindParam(':id', $lastUserId);
                    $stmt->execute();
                } elseif ($role === 'secretaire') {
                    $stmt = $pdo->prepare("INSERT INTO secretaire (Id_Secretaire) VALUES (:id)");
                    $stmt->bindParam(':id', $lastUserId);
                    $stmt->execute();
                } elseif ($role === 'tuteur_entreprise' && $entrepriseId) {
                    $stmt = $pdo->prepare("INSERT INTO tuteur_entreprise (Id_Tuteur_Entreprise, Id_Entreprise) VALUES (:id, :entreprise)");
                    $stmt->bindParam(':id', $lastUserId);
                    $stmt->bindParam(':entreprise', $entrepriseId);
                    $stmt->execute();
                } elseif ($role === 'administrateur') {
                    $stmt = $pdo->prepare("INSERT INTO administrateur (Id_Administrateur) VALUES (:id)");
                    $stmt->bindParam(':id', $lastUserId);
                    $stmt->execute();
                }

                echo "<div class='alert success'>Utilisateur ajouté avec succès.</div>";
            } catch (PDOException $e) {
                echo "<div class='alert error'>Erreur : " . $e->getMessage() . "</div>";
            }
        }

            ?>
        </section>
    </div>

    <script>
        const roleSelect = document.getElementById('role');
        const etudiantSection = document.getElementById('etudiant-section');
        const entrepriseSection = document.getElementById('entreprise-section');

        roleSelect.addEventListener('change', () => {
            etudiantSection.style.display = roleSelect.value === 'etudiant' ? 'block' : 'none';
            entrepriseSection.style.display = roleSelect.value === 'tuteur_entreprise' ? 'block' : 'none';
        });
    </script>
</body>

</html>
