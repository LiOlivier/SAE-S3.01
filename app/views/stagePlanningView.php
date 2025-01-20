<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stage Planning - Responsable de Stage</title>
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
        <h1 id="titre">Stage Planning</h1>
        <div class="cards">
            <?php if (isset($message)) { ?>
                <p><?php echo htmlspecialchars($message, ENT_QUOTES); ?></p>
            <?php } ?>
            <section id="add-stage">
                <h2>Ajouter un Stage</h2>
                <form action="stage-planning.php" method="post">
                    <label for="student">Sélectionner un étudiant :</label>
                    <select id="student" name="student">
                        <?php foreach ($etudiants as $etudiant) { ?>
                            <option value="<?php echo htmlspecialchars($etudiant['Id_Etudiant'], ENT_QUOTES); ?>">
                                <?php echo htmlspecialchars($etudiant['nom'], ENT_QUOTES) . ' ' . htmlspecialchars($etudiant['prenom'], ENT_QUOTES); ?>
                            </option>
                        <?php } ?>
                    </select><br>

                    <label for="semester">Sélectionner le semestre :</label>
                    <select id="semester" name="semester">
                        <option value="4">Semestre 4</option>
                        <option value="6">Semestre 6</option>
                    </select><br>

                    <label for="Id_Departement">Sélectionner le département :</label>
                    <select id="Id_Departement" name="Id_Departement">
                        <?php foreach ($departements as $departement) { ?>
                            <option value="<?php echo htmlspecialchars($departement['Id_Departement'], ENT_QUOTES); ?>">
                                <?php echo htmlspecialchars($departement['Libelle'], ENT_QUOTES); ?>
                            </option>
                        <?php } ?>
                    </select><br>

                    <label for="start_date">Date de début :</label>
                    <input type="date" id="start_date" name="start_date"><br>

                    <label for="end_date">Date de fin :</label>
                    <input type="date" id="end_date" name="end_date"><br>

                    <label for="mission">Mission :</label>
                    <textarea id="mission" name="mission"></textarea><br>

                    <button type="submit" name="add_stage">Ajouter le Stage</button>
                </form>
            </section>

            <section id="assign-tuteur">
                <h2>Assignation des Tuteurs</h2>
                <form action="stage-planning.php" method="post">
                    <label for="student">Sélectionner un étudiant :</label>
                    <select id="student" name="student">
                        <?php foreach ($stageStudents as $etudiant) { ?>
                            <option value="<?php echo htmlspecialchars($etudiant['Id_Etudiant'], ENT_QUOTES); ?>">
                                <?php echo htmlspecialchars($etudiant['nom'], ENT_QUOTES) . ' ' . htmlspecialchars($etudiant['prenom'], ENT_QUOTES); ?>
                            </option>
                        <?php } ?>
                    </select><br>

                    <label for="semester">Sélectionner le semestre :</label>
                    <select id="semester" name="semester">
                        <option value="4">Semestre 4</option>
                        <option value="6">Semestre 6</option>
                    </select><br>

                    <label for="tuteur_pedagogique">Sélectionner un tuteur pédagogique :</label>
                    <select id="tuteur_pedagogique" name="tuteur_pedagogique">
                        <?php foreach ($tuteursPedagogiques as $tuteur) { ?>
                            <option value="<?php echo htmlspecialchars($tuteur['Id_Enseignant'], ENT_QUOTES); ?>">
                                <?php echo htmlspecialchars($tuteur['nom'], ENT_QUOTES) . ' ' . htmlspecialchars($tuteur['prenom'], ENT_QUOTES); ?>
                            </option>
                        <?php } ?>
                    </select><br>

                    <label for="tuteur_entreprise">Sélectionner un tuteur entreprise :</label>
                    <select id="tuteur_entreprise" name="tuteur_entreprise">
                        <?php foreach ($tuteursEntreprises as $tuteur) { ?>
                            <option value="<?php echo htmlspecialchars($tuteur['Id_Tuteur_Entreprise'], ENT_QUOTES); ?>">
                                <?php echo htmlspecialchars($tuteur['nom'], ENT_QUOTES) . ' ' . htmlspecialchars($tuteur['prenom'], ENT_QUOTES); ?>
                            </option>
                        <?php } ?>
                    </select><br>

                    <button type="submit" name="assign_tuteur">Assigner les Tuteurs</button>
                </form>
            </section>

            <section id="jury-management">
                <h2>Gestion du jury</h2>
                <form action="stage-planning.php" method="post">
                    <label for="student">Sélectionner un étudiant :</label>
                    <select id="student" name="student">
                        <?php foreach ($stageStudents as $etudiant) { ?>
                            <option value="<?php echo htmlspecialchars($etudiant['Id_Etudiant'], ENT_QUOTES); ?>">
                                <?php echo htmlspecialchars($etudiant['nom'], ENT_QUOTES) . ' ' . htmlspecialchars($etudiant['prenom'], ENT_QUOTES); ?>
                            </option>
                        <?php } ?>
                    </select><br>

                    <label for="semester">Sélectionner le semestre :</label>
                    <select id="semester" name="semester">
                        <option value="4">Semestre 4</option>
                        <option value="6">Semestre 6</option>
                    </select><br>

                    <label for="jury">Assigner un membre du jury :</label>
                    <select id="jury" name="jury">
                        <?php foreach ($enseignants as $enseignant) { ?>
                            <option value="<?php echo htmlspecialchars($enseignant['Id_Enseignant'], ENT_QUOTES); ?>">
                                <?php echo htmlspecialchars($enseignant['nom'], ENT_QUOTES) . ' ' . htmlspecialchars($enseignant['prenom'], ENT_QUOTES); ?>
                            </option>
                        <?php } ?>
                    </select><br>

                    <label for="date">Date de soutenance :</label>
                    <input type="date" id="date" name="date"><br>

                    <label for="salle_soutenance">Salle de soutenance :</label>
                    <input type="text" id="salle_soutenance" name="salle_soutenance"><br>

                    <button type="submit" name="assign_jury">Assigner le jury</button>
                </form>
            </section>
        </div>
    </section>
</body>
</html>