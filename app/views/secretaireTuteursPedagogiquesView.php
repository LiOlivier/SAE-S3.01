<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Tuteurs Pédagogiques</title>
    <link rel="stylesheet" href="../CSS/aside.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/secretaire.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
        integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <style>
        .table-wrapper { margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
        th { background-color: #003366; color: #ffffff; }
        .common-pagination { display: flex; gap: 10px; justify-content: center; align-items: center; margin-top: 20px; }
        .common-pagination button { padding: 8px 12px; background-color: #003366; color: #fff; border: none; border-radius: 8px; cursor: pointer; font-size: 0.9rem; transition: background-color 0.3s ease; }
        .common-pagination button:hover:not(:disabled) { background-color: #005599; }
        .common-pagination button:disabled { background-color: #cccccc; cursor: not-allowed; }
        .common-pagination select { width: auto; min-width: 80px; height: 34px; padding: 8px; border: 1px solid #003366; border-radius: 8px; font-size: 0.9rem; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); }
    </style>
</head>
<body class="body">
    <?php require_once(__DIR__ . "/../component/header.php"); ?>
    <?php require_once(__DIR__ . "/../component/aside.php"); ?>
    <?php 
        // Default pagination values to prevent undefined errors
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $rowsPerPage = isset($_GET['rows']) && in_array((int)$_GET['rows'], [5, 10, 25, 50]) ? (int)$_GET['rows'] : 10;
        $totalPages = isset($totalPages) ? max(1, (int)$totalPages) : 1;
    ?>
    <div id="one">
        <div class="cards">
            <h1 id="titre">Liste des Tuteurs Pédagogiques</h1>
            <?php if (!empty($tutorsPedagogiques)): ?>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tutorsPedagogiques as $tutor): ?>
                                <tr>
                                    <td><?= htmlspecialchars($tutor['nom'] ?? 'N/A') ?></td>
                                    <td><?= htmlspecialchars($tutor['prenom'] ?? 'N/A') ?></td>
                                    <td><?= htmlspecialchars($tutor['email'] ?? 'N/A') ?></td>
                                    <td><?= htmlspecialchars($tutor['telephone'] ?? 'N/A') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="common-pagination">
                    <button onclick="changePage(<?php echo $page - 1; ?>)" <?php echo $page <= 1 ? 'disabled' : ''; ?>>Précédent</button>
                    <span id="page-info">Page <?php echo $page; ?> sur <?php echo $totalPages; ?></span>
                    <button onclick="changePage(<?php echo $page + 1; ?>)" <?php echo $page >= $totalPages ? 'disabled' : ''; ?>>Suivant</button>
                    <select id="rowsPerPage" onchange="changeRowsPerPage()">
                        <?php foreach ([5, 10, 25, 50] as $rows): ?>
                            <option value="<?php echo $rows; ?>" <?php echo $rowsPerPage == $rows ? 'selected' : ''; ?>>
                                <?php echo $rows; ?> par page
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <script>
                    function changePage(page) {
                        const params = new URLSearchParams(window.location.search);
                        params.set('page', Math.max(1, page));
                        window.location.href = '?' + params.toString();
                    }
                    function changeRowsPerPage() {
                        const params = new URLSearchParams(window.location.search);
                        params.set('rows', document.getElementById('rowsPerPage').value);
                        params.set('page', 1);
                        window.location.href = '?' + params.toString();
                    }
                </script>
            <?php else: ?>
                <p style="color: #ff0000;">Aucun tuteur pédagogique trouvé.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>