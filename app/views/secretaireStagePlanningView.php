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
    <link rel="stylesheet" href="../CSS/secretaire.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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

            <div class="form-section" id="add-stage">
                <h2>Ajouter un Stage</h2>
                <form action="stage-planning.php" method="post">
                    <label for="student_add">Sélectionner un étudiant :</label>
                    <select id="student_add" name="student" class="searchable">
                        <?php foreach ($etudiants as $etudiant) { ?>
                            <option value="<?php echo htmlspecialchars($etudiant['Id_Etudiant'], ENT_QUOTES); ?>">
                                <?php echo htmlspecialchars($etudiant['nom'], ENT_QUOTES) . ' ' . htmlspecialchars($etudiant['prenom'], ENT_QUOTES); ?>
                            </option>
                        <?php } ?>
                    </select>

                    <label for="semester_add">Sélectionner le semestre :</label>
                    <select id="semester_add" name="semester">
                        <option value="4">Semestre 4</option>
                        <option value="6">Semestre 6</option>
                    </select>

                    <label for="Id_Departement">Sélectionner le département :</label>
                    <select id="Id_Departement" name="Id_Departement" class="searchable">
                        <?php foreach ($departements as $departement) { ?>
                            <option value="<?php echo htmlspecialchars($departement['Id_Departement'], ENT_QUOTES); ?>">
                                <?php echo htmlspecialchars($departement['Libelle'], ENT_QUOTES); ?>
                            </option>
                        <?php } ?>
                    </select>

                    <label for="start_date">Date de début :</label>
                    <input type="date" id="start_date" name="start_date">

                    <label for="end_date">Date de fin :</label>
                    <input type="date" id="end_date" name="end_date">

                    <label for="mission">Mission :</label>
                    <textarea id="mission" name="mission"></textarea>

                    <button type="submit" name="add_stage">Ajouter le Stage</button>
                </form>
            </div>

            <div class="form-section" id="assign-tuteur">
                <h2>Assignation des Tuteurs</h2>
                <form action="stage-planning.php" method="post">
                    <label for="student_tuteur">Sélectionner un étudiant :</label>
                    <select id="student_tuteur" name="student" class="searchable">
                        <?php foreach ($stageStudents as $etudiant) { ?>
                            <option value="<?php echo htmlspecialchars($etudiant['Id_Etudiant'], ENT_QUOTES); ?>">
                                <?php echo htmlspecialchars($etudiant['nom'], ENT_QUOTES) . ' ' . htmlspecialchars($etudiant['prenom'], ENT_QUOTES); ?>
                            </option>
                        <?php } ?>
                    </select>

                    <label for="semester_tuteur">Sélectionner le semestre :</label>
                    <select id="semester_tuteur" name="semester">
                        <option value="4">Semestre 4</option>
                        <option value="6">Semestre 6</option>
                    </select>

                    <label for="tuteur_pedagogique">Sélectionner un tuteur pédagogique :</label>
                    <select id="tuteur_pedagogique" name="tuteur_pedagogique" class="searchable">
                        <?php foreach ($tuteursPedagogiques as $tuteur) { ?>
                            <option value="<?php echo htmlspecialchars($tuteur['Id_Enseignant'], ENT_QUOTES); ?>">
                                <?php echo htmlspecialchars($tuteur['nom'], ENT_QUOTES) . ' ' . htmlspecialchars($tuteur['prenom'], ENT_QUOTES); ?>
                            </option>
                        <?php } ?>
                    </select>

                    <label for="tuteur_entreprise">Sélectionner un tuteur entreprise :</label>
                    <select id="tuteur_entreprise" name="tuteur_entreprise" class="searchable">
                        <?php foreach ($tuteursEntreprises as $tuteur) { ?>
                            <option value="<?php echo htmlspecialchars($tuteur['Id_Tuteur_Entreprise'], ENT_QUOTES); ?>">
                                <?php echo htmlspecialchars($tuteur['nom'], ENT_QUOTES) . ' ' . htmlspecialchars($tuteur['prenom'], ENT_QUOTES); ?>
                            </option>
                        <?php } ?>
                    </select>

                    <button type="submit" name="assign_tuteur">Assigner les Tuteurs</button>
                </form>
            </div>

            <div class="form-section" id="jury-management">
                <h2>Gestion du jury</h2>
                <form action="stage-planning.php" method="post">
                    <label for="student_jury">Sélectionner un étudiant :</label>
                    <select id="student_jury" name="student" class="searchable">
                        <?php foreach ($stageStudents as $etudiant) { ?>
                            <option value="<?php echo htmlspecialchars($etudiant['Id_Etudiant'], ENT_QUOTES); ?>">
                                <?php echo htmlspecialchars($etudiant['nom'], ENT_QUOTES) . ' ' . htmlspecialchars($etudiant['prenom'], ENT_QUOTES); ?>
                            </option>
                        <?php } ?>
                    </select>

                    <label for="semester_jury">Sélectionner le semestre :</label>
                    <select id="semester_jury" name="semester">
                        <option value="4">Semestre 4</option>
                        <option value="6">Semestre 6</option>
                    </select>

                    <label for="jury">Assigner un membre du jury :</label>
                    <select id="jury" name="jury" class="searchable">
                        <?php foreach ($enseignants as $enseignant) { ?>
                            <option value="<?php echo htmlspecialchars($enseignant['Id_Enseignant'], ENT_QUOTES); ?>">
                                <?php echo htmlspecialchars($enseignant['nom'], ENT_QUOTES) . ' ' . htmlspecialchars($enseignant['prenom'], ENT_QUOTES); ?>
                            </option>
                        <?php } ?>
                    </select>

                    <label for="date">Date de soutenance :</label>
                    <input type="date" id="date" name="date">

                    <label for="salle_soutenance">Salle de soutenance :</label>
                    <input type="text" id="salle_soutenance" name="salle_soutenance">

                    <button type="submit" name="assign_jury">Assigner le jury</button>
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