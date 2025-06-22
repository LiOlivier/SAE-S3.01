<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Tuteurs Entreprise</title>
    <link rel="stylesheet" href="../CSS/aside.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/secretaire.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
          integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <style>
        th, th a, th a:hover, th a:visited {
            color: #ffffff;
            text-decoration: none;
        }
        th.common-sortable {
            cursor: pointer;
        }
        th.common-sortable:hover {
            background-color: #005599;
        }
        .common-filter-section {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 20px;
            align-items: flex-start;
            padding: 10px;
        }
        .common-filter-section label {
            margin-right: 5px;
            font-weight: bold;
            color: #555;
            font-size: 0.9rem;
            white-space: nowrap;
        }
        .common-filter-input {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 10px;
            padding: 10px;
            margin: 0 auto;
        }
        .common-filter-section input[type="text"], .common-filter-section select, .common-filter-section button {
            max-width: 200px;
            height: 34px;
            padding: 8px;
            border: 1px solid #003366;
            border-radius: 8px;
            font-size: 0.9rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            margin: 0;
        }
        .common-filter-section button {
            margin-left: auto;
            background-color: #003366;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
            padding: 8px 16px;
        }
        .common-filter-section input:focus, .common-filter-section select:focus, .common-filter-section button:focus {
            border-color: #005599;
            box-shadow: 0 0 8px rgba(0, 53, 102, 0.3);
            outline: none;
        }
        .common-filter-section button:hover {
            background-color: #005599;
        }
        .common-pagination {
            display: flex;
            gap: 10px;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }
        .common-pagination button {
            padding: 8px 12px;
            background-color: #003366;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background-color 0.3s ease;
        }
        .common-pagination button:hover:not(:disabled) {
            background-color: #005599;
        }
        .common-pagination button:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }
        .common-pagination select {
            width: auto;
            min-width: 80px;
            height: 34px;
            padding: 8px;
            border: 1px solid #003366;
            border-radius: 8px;
            font-size: 0.9rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .message {
            margin-top: 10px;
            padding: 10px;
            border-radius: 4px;
        }
        .success { background-color: #d4edda; color: #155724; }
        .error { background-color: #f8d7da; color: #721c24; }
        .table-wrapper { margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
        th { background-color: #003366; color: #ffffff; }
        .clickable { cursor: pointer; }
        .clickable:hover { background-color: #f5f5f5; }
    </style>
</head>
<body class="body">
    <?php require_once(__DIR__ . "/../component/header.php"); ?>
    <?php require_once(__DIR__ . "/../component/aside.php"); ?>
    <?php 
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $rowsPerPage = isset($_GET['rows']) && in_array((int)$_GET['rows'], [5, 10, 25, 50]) ? (int)$_GET['rows'] : 10;
        $search = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';
        $sort = isset($_GET['sort']) && in_array($_GET['sort'], ['nom', 'prenom', 'email', 'telephone']) ? $_GET['sort'] : 'nom';
        $order = isset($_GET['order']) && $_GET['order'] === 'desc' ? 'desc' : 'asc';
        $message = $message ?? null;
    ?>
    <div id="one">
        <h1 id="titre">Liste des Tuteurs Entreprise</h1>
        <div class="cards">
            <?php if ($message): ?>
                <div class="message <?php echo $message['type']; ?>"><?php echo $message['text']; ?></div>
            <?php endif; ?>
            <div class="common-filter-section">
                <div class="common-filter-input">
                    <label for="search">Rechercher :</label>
                    <input type="text" id="search" value="<?php echo $search; ?>" placeholder="Nom, Prénom, Email, Téléphone">
                    <button onclick="updateTable()">Rechercher</button>
                </div>
            </div>
            <?php if (!empty($tuteursEntreprise)): ?>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th class="common-sortable" onclick="sortTuteurs('nom')">Nom <?php echo $sort === 'nom' ? ($order === 'asc' ? '↑' : '↓') : ''; ?></th>
                                <th class="common-sortable" onclick="sortTuteurs('prenom')">Prénom <?php echo $sort === 'prenom' ? ($order === 'asc' ? '↑' : '↓') : ''; ?></th>
                                <th class="common-sortable" onclick="sortTuteurs('email')">Email <?php echo $sort === 'email' ? ($order === 'asc' ? '↑' : '↓') : ''; ?></th>
                                <th class="common-sortable" onclick="sortTuteurs('telephone')">Téléphone <?php echo $sort === 'telephone' ? ($order === 'asc' ? '↑' : '↓') : ''; ?></th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <?php foreach ($tuteursEntreprise as $tuteur): ?>
                                <tr>
                                    <td class="clickable" onclick="window.location.href='secretaire-entreprise-details.php?id=<?= $tuteur['id_tuteur_entreprise'] ?>'"><?= htmlspecialchars($tuteur['nom'] ?? 'N/A') ?></td>
                                    <td class="clickable" onclick="window.location.href='secretaire-entreprise-details.php?id=<?= $tuteur['id_tuteur_entreprise'] ?>'"><?= htmlspecialchars($tuteur['prenom'] ?? 'N/A') ?></td>
                                    <td class="clickable" onclick="window.location.href='secretaire-entreprise-details.php?id=<?= $tuteur['id_tuteur_entreprise'] ?>'"><?= htmlspecialchars($tuteur['email'] ?? 'N/A') ?></td>
                                    <td class="clickable" onclick="window.location.href='secretaire-entreprise-details.php?id=<?= $tuteur['id_tuteur_entreprise'] ?>'"><?= htmlspecialchars($tuteur['telephone'] ?? 'N/A') ?></td>
                                    <td>
                                        <form method="POST" action="" style="display:inline;" onsubmit="return confirmDelete(event, this)">
                                            <input type="hidden" name="id" value="<?= $tuteur['id_tuteur_entreprise'] ?>">
                                            <input type="hidden" name="action" value="remove">
                                            <button type="submit">Supprimer</button>
                                        </form>
                                        <form method="GET" action="modifier-tuteur-entreprise.php" style="display:inline;">
                                            <input type="hidden" name="id" value="<?= $tuteur['id_tuteur_entreprise'] ?>">
                                            <button type="submit">Modifier</button>
                                        </form>
                                    </td>
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
                    // Store initial data from PHP
                    const initialData = <?php echo json_encode($tuteursEntreprise); ?>;
                    let currentData = [...initialData];

                    function updateTable() {
                        const search = document.getElementById('search').value.toLowerCase();
                        const tbody = document.getElementById('table-body');

                        currentData = initialData.filter(tuteur => {
                            return (
                                tuteur.nom.toLowerCase().includes(search) ||
                                tuteur.prenom.toLowerCase().includes(search) ||
                                tuteur.email.toLowerCase().includes(search) ||
                                tuteur.telephone.toLowerCase().includes(search)
                            );
                        });

                        tbody.innerHTML = '';
                        if (currentData.length === 0) {
                            tbody.innerHTML = '<tr><td colspan="5">Aucun tuteur entreprise trouvé.</td></tr>';
                        } else {
                            currentData.forEach(tuteur => {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                                    <td class="clickable" onclick="window.location.href='secretaire-entreprise-details.php?id=${tuteur.id_tuteur_entreprise}'">${escapeHtml(tuteur.nom)}</td>
                                    <td class="clickable" onclick="window.location.href='secretaire-entreprise-details.php?id=${tuteur.id_tuteur_entreprise}'">${escapeHtml(tuteur.prenom)}</td>
                                    <td class="clickable" onclick="window.location.href='secretaire-entreprise-details.php?id=${tuteur.id_tuteur_entreprise}'">${escapeHtml(tuteur.email)}</td>
                                    <td class="clickable" onclick="window.location.href='secretaire-entreprise-details.php?id=${tuteur.id_tuteur_entreprise}'">${escapeHtml(tuteur.telephone)}</td>
                                    <td>
                                        <form method="POST" action="" style="display:inline;" onsubmit="return confirmDelete(event, this)">
                                            <input type="hidden" name="id" value="${tuteur.id_tuteur_entreprise}">
                                            <input type="hidden" name="action" value="remove">
                                            <button type="submit">Supprimer</button>
                                        </form>
                                        <form method="GET" action="modifier-tuteur-entreprise.php" style="display:inline;">
                                            <input type="hidden" name="id" value="${tuteur.id_tuteur_entreprise}">
                                            <button type="submit">Modifier</button>
                                        </form>
                                    </td>
                                `;
                                tbody.appendChild(row);
                            });
                        }
                    }

                    function escapeHtml(str) {
                        const div = document.createElement('div');
                        div.textContent = str;
                        return div.innerHTML;
                    }

                    function sortTuteurs(column) {
                        const params = new URLSearchParams(window.location.search);
                        const currentOrder = params.get('order') === 'desc' ? 'asc' : 'desc';
                        params.set('sort', column);
                        params.set('order', currentOrder);
                        params.set('page', 1);
                        window.location.href = '?' + params.toString();
                    }

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

                    function confirmDelete(event, form) {
                        event.preventDefault(); // Prevent default form submission
                        const confirmed = confirm('Confirmer la suppression ?');
                        if (confirmed) {
                            form.submit(); // Submit the form only if confirmed
                        }
                        return false; // Ensure no default action
                    }

                    document.addEventListener('DOMContentLoaded', function() {
                        const searchInput = document.getElementById('search');
                        searchInput.addEventListener('input', () => {
                            clearTimeout(window.searchTimeout);
                            window.searchTimeout = setTimeout(updateTable, 1000); // Debounce
                        });
                        searchInput.addEventListener('keypress', (e) => {
                            if (e.key === 'Enter') {
                                updateTable();
                            }
                        });
                    });
                </script>
            <?php else: ?>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th class="common-sortable" onclick="sortTuteurs('nom')">Nom <?php echo $sort === 'nom' ? ($order === 'asc' ? '↑' : '↓') : ''; ?></th>
                                <th class="common-sortable" onclick="sortTuteurs('prenom')">Prénom <?php echo $sort === 'prenom' ? ($order === 'asc' ? '↑' : '↓') : ''; ?></th>
                                <th class="common-sortable" onclick="sortTuteurs('email')">Email <?php echo $sort === 'email' ? ($order === 'asc' ? '↑' : '↓') : ''; ?></th>
                                <th class="common-sortable" onclick="sortTuteurs('telephone')">Téléphone <?php echo $sort === 'telephone' ? ($order === 'asc' ? '↑' : '↓') : ''; ?></th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <tr><td colspan="5">Aucun tuteur entreprise trouvé.</td></tr>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>