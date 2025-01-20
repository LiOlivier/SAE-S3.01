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
        require_once(__DIR__ . "/../component/header.php");
        require_once(__DIR__ . "/../component/aside.php"); 
    ?>

    <section id="one">
        <h1 id="titre">Gestion des Tuteurs</h1>
        <div class="cards">
            <?php if (isset($message)) { ?>
                <p><?php echo htmlspecialchars($message, ENT_QUOTES); ?></p>
            <?php } ?>
            <section id="add-tuteur-pedagogique">
                <h2>Ajouter un Tuteur Pédagogique</h2>
                <form action="tuteur.php" method="post">
                    <label for="enseignant">Sélectionner un enseignant :</label>
                    <select id="enseignant" name="enseignant">
                        <?php foreach ($enseignants as $enseignant) { ?>
                            <option value="<?php echo htmlspecialchars($enseignant['id'], ENT_QUOTES); ?>">
                                <?php echo htmlspecialchars($enseignant['nom'], ENT_QUOTES) . ' ' . htmlspecialchars($enseignant['prenom'], ENT_QUOTES); ?>
                            </option>
                        <?php } ?>
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
                        <?php foreach ($entreprises as $entreprise) { ?>
                            <option value="<?php echo htmlspecialchars($entreprise['Id_Entreprise'], ENT_QUOTES); ?>">
                                <?php echo htmlspecialchars($entreprise['Id_Entreprise'], ENT_QUOTES); ?>
                            </option>
                        <?php } ?>
                    </select><br>
                    <button type="submit" name="add_tuteur_entreprise">Ajouter le Tuteur Entreprise</button>
                </form>
            </section>
        </div>
    </section>
</body>
</html>