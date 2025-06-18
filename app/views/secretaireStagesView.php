<?php
$title = "Liste des Stages - Responsable de Stage";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <link rel="stylesheet" href="../CSS/aside.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/secretaire.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
        integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
</head>
<body class="body">
    <?php 
        require_once(__DIR__ . "/../component/header.php");
        require_once(__DIR__ . "/../component/aside.php"); 
    ?>

    <div id="one">
        <div class="cards">
            <h1 id="titre">Liste des Stages</h1>

            <!-- Filter Form -->
            <form method="GET" action="">
                <div class="form-section">
                    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                        <div style="flex: 1; min-width: 200px;">
                            <label for="department">Département</label>
                            <select name="department" id="department">
                                <option value="">Tous les départements</option>
                                <?php foreach ($departments as $dept): ?>
                                    <option value="<?= htmlspecialchars($dept['id_departement']) ?>" <?= isset($_GET['department']) && $_GET['department'] == $dept['id_departement'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($dept['libelle']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div style="flex: 1; min-width: 200px;">
                            <label for="year">Année</label>
                            <select name="year" id="year">
                                <option value="">Toutes les années</option>
                                <?php foreach ($years as $year): ?>
                                    <option value="<?= htmlspecialchars($year['annee']) ?>" <?= isset($_GET['year']) && $_GET['year'] == $year['annee'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($year['annee']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div style="flex: 1; min-width: 200px;">
                            <label for="search">Rechercher</label>
                            <input type="text" name="search" id="search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" placeholder="Nom étudiant/ville entreprise">
                        </div>
                        <div style="align-self: flex-end;">
                            <button type="submit"><i class="fas fa-filter"></i> Filtrer</button>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Stages Table -->
            <?php if (!empty($stages)): ?>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    <a href="?sort=student_name&order=<?= isset($_GET['sort']) && $_GET['sort'] == 'student_name' && $_GET['order'] == 'ASC' ? 'DESC' : 'ASC' ?>&department=<?= isset($_GET['department']) ? urlencode($_GET['department']) : '' ?>&year=<?= isset($_GET['year']) ? urlencode($_GET['year']) : '' ?>&search=<?= isset($_GET['search']) ? urlencode($_GET['search']) : '' ?>">
                                        Étudiant <i class="fas fa-sort"></i>
                                    </a>
                                </th>
                                <th>
                                    <a href="?sort=company_name&order=<?= isset($_GET['sort']) && $_GET['sort'] == 'company_name' && $_GET['order'] == 'ASC' ? 'DESC' : 'ASC' ?>&department=<?= isset($_GET['department']) ? urlencode($_GET['department']) : '' ?>&year=<?= isset($_GET['year']) ? urlencode($_GET['year']) : '' ?>&search=<?= isset($_GET['search']) ? urlencode($_GET['search']) : '' ?>">
                                        Ville Entreprise <i class="fas fa-sort"></i>
                                    </a>
                                </th>
                                <th>Tuteur Pédagogique</th>
                                <th>
                                    <a href="?sort=date_debut&order=<?= isset($_GET['sort']) && $_GET['sort'] == 'date_debut' && $_GET['order'] == 'ASC' ? 'DESC' : 'ASC' ?>&department=<?= isset($_GET['department']) ? urlencode($_GET['department']) : '' ?>&year=<?= isset($_GET['year']) ? urlencode($_GET['year']) : '' ?>&search=<?= isset($_GET['search']) ? urlencode($_GET['search']) : '' ?>">
                                        Date de Début <i class="fas fa-sort"></i>
                                    </a>
                                </th>
                                <th>
                                    <a href="?sort=date_fin&order=<?= isset($_GET['sort']) && $_GET['sort'] == 'date_fin' && $_GET['order'] == 'ASC' ? 'DESC' : 'ASC' ?>&department=<?= isset($_GET['department']) ? urlencode($_GET['department']) : '' ?>&year=<?= isset($_GET['year']) ? urlencode($_GET['year']) : '' ?>&search=<?= isset($_GET['search']) ? urlencode($_GET['search']) : '' ?>">
                                        Date de Fin <i class="fas fa-sort"></i>
                                    </a>
                                </th>
                                <th>Mission</th>
                                <th>Date de Soutenance</th>
                                <th>Salle</th>
                                <th>Second Jury</th>
                                <th>
                                    <a href="?sort=overdue_actions&order=<?= isset($_GET['sort']) && $_GET['sort'] == 'overdue_actions' && $_GET['order'] == 'ASC' ? 'DESC' : 'ASC' ?>&department=<?= isset($_GET['department']) ? urlencode($_GET['department']) : '' ?>&year=<?= isset($_GET['year']) ? urlencode($_GET['year']) : '' ?>&search=<?= isset($_GET['search']) ? urlencode($_GET['search']) : '' ?>">
                                        Actions en Retard <i class="fas fa-sort"></i>
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($stages as $stage): ?>
                                <tr>
                                    <td><?= htmlspecialchars($stage['student_name']) ?></td>
                                    <td><?= htmlspecialchars($stage['company_name'] ?? 'N/A') ?></td>
                                    <td><?= htmlspecialchars($stage['academic_tutor_name'] ?? 'N/A') ?></td>
                                    <td><?= htmlspecialchars($stage['date_debut']) ?></td>
                                    <td><?= htmlspecialchars($stage['date_fin']) ?></td>
                                    <td><?= htmlspecialchars($stage['mission']) ?></td>
                                    <td><?= htmlspecialchars($stage['date_soutenance'] ?? 'Non planifiée') ?></td>
                                    <td><?= htmlspecialchars($stage['salle_soutenance'] ?? 'N/A') ?></td>
                                    <td><?= htmlspecialchars($stage['second_jury_name'] ?? 'Non assigné') ?></td>
                                    <td style="<?= $stage['overdue_actions'] > 0 ? 'color: #ff0000; font-weight: bold;' : '' ?>">
                                        <?= htmlspecialchars($stage['overdue_actions']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p style="color: #ff0000;">Aucun stage trouvé.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>