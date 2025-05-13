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
    <link rel="stylesheet" href="../CSS/rs.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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

            <div class="form-section" id="add-tuteur-pedagogique">
                <h2>Ajouter un Tuteur Pédagogique</h2>
                <form action="tuteur.php" method="post">
                    <label for="enseignant">Sélectionner un enseignant :</label>
                    <select id="enseignant" name="enseignant" class="searchable">
                        <?php foreach ($enseignants as $enseignant) { ?>
                            <option value="<?php echo htmlspecialchars($enseignant['id'], ENT_QUOTES); ?>">
                                <?php echo htmlspecialchars($enseignant['nom'], ENT_QUOTES) . ' ' . htmlspecialchars($enseignant['prenom'], ENT_QUOTES); ?>
                            </option>
                        <?php } ?>
                    </select>
                    <button type="submit" name="add_tuteur_pedagogique">Ajouter le Tuteur Pédagogique</button>
                </form>
            </div>

            <div class="form-section" id="add-tuteur-entreprise">
                <h2>Ajouter un Tuteur Entreprise</h2>
                <form action="tuteur.php" method="post">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" required>

                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" required>

                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" required>

                    <label for="telephone">Téléphone :</label>
                    <input type="text" id="telephone" name="telephone" required>

                    <label for="login">Login :</label>
                    <input type="text" id="login" name="login" required>

                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" required>

                    <label for="entreprise">Sélectionner une entreprise :</label>
                    <select id="entreprise" name="entreprise" class="searchable">
                        <?php foreach ($entreprises as $entreprise) { ?>
                            <option value="<?php echo htmlspecialchars($entreprise['Id_Entreprise'], ENT_QUOTES); ?>">
                                <?php echo htmlspecialchars($entreprise['Id_Entreprise'], ENT_QUOTES); ?>
                            </option>
                        <?php } ?>
                    </select>
                    <button type="submit" name="add_tuteur_entreprise">Ajouter le Tuteur Entreprise</button>
                </form>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            console.log('jQuery and Select2 loaded');
            $('.searchable').each(function() {
                console.log('Initializing Select2 on:', this.id);
                $(this).select2({
                    placeholder: "Rechercher...",
                    allowClear: true,
                    width: '100%'
                });
            });
        });
    </script>
</body>
</html>