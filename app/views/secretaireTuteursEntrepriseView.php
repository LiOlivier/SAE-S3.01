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
                    <button onclick="submitSearch()">Rechercher</button>
                </div>
            </div>
            <?php if (!empty($tuteursEntreprise)): ?>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th class="clickable-row" onclick="sortTuteurs('nom')">Nom <?php echo $sort === 'nom' ? ($order === 'asc' ? '↑' : '↓') : ''; ?></th>
                                <th class="clickable-row" onclick="sortTuteurs('prenom')">Prénom <?php echo $sort === 'prenom' ? ($order === 'asc' ? '↑' : '↓') : ''; ?></th>
                                <th class="clickable-row" onclick="sortTuteurs('email')">Email <?php echo $sort === 'email' ? ($order === 'asc' ? '↑' : '↓') : ''; ?></th>
                                <th class="clickable-row" onclick="sortTuteurs('telephone')">Téléphone <?php echo $sort === 'telephone' ? ($order === 'asc' ? '↑' : '↓') : ''; ?></th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <?php foreach ($tuteursEntreprise as $tuteur): ?>
                                <tr>
                                    <td class="clickable-column" onclick="window.location.href='secretaire-entreprise-details.php?id=<?= $tuteur['id_tuteur_entreprise'] ?>'"><?= htmlspecialchars($tuteur['nom'] ?? 'N/A') ?></td>
                                    <td class="clickable-column" onclick="window.location.href='secretaire-entreprise-details.php?id=<?= $tuteur['id_tuteur_entreprise'] ?>'"><?= htmlspecialchars($tuteur['prenom'] ?? 'N/A') ?></td>
                                    <td class="clickable-column" onclick="window.location.href='secretaire-entreprise-details.php?id=<?= $tuteur['id_tuteur_entreprise'] ?>'"><?= htmlspecialchars($tuteur['email'] ?? 'N/A') ?></td>
                                    <td class="clickable-column" onclick="window.location.href='secretaire-entreprise-details.php?id=<?= $tuteur['id_tuteur_entreprise'] ?>'"><?= htmlspecialchars($tuteur['telephone'] ?? 'N/A') ?></td>
                                    <td>
                                        <form method="POST" action="" style="display:inline;" onsubmit="return confirmDelete(event, this)">
                                            <input type="hidden" name="id" value="<?= $tuteur['id_tuteur_entreprise'] ?>">
                                            <input type="hidden" name="action" value="remove">
                                            <button type="submit">Supprimer</button>
                                        </form>
                                        <form method="GET" action="secretaire-modifier-entreprise.php" style="display:inline;">
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
                    function sortTuteurs(column) {
                        const params = new URLSearchParams(window.location.search);
                        const currentSort = params.get('sort');
                        const currentOrder = params.get('order') === 'desc' ? 'desc' : 'asc';
                        let newOrder = 'asc';
                        if (currentSort === column && currentOrder === 'asc') {
                            newOrder = 'desc';
                        }
                        params.set('sort', column);
                        params.set('order', newOrder);
                        // preserve current page
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
                        event.preventDefault();
                        const confirmed = confirm('Confirmer la suppression ?');
                        if (confirmed) {
                            form.submit();
                        }
                        return false;
                    }

                    function submitSearch() {
                        const params = new URLSearchParams(window.location.search);
                        params.set('search', document.getElementById('search').value);
                        params.set('page', 1);
                        window.location.href = '?' + params.toString();
                    }

                    document.addEventListener('DOMContentLoaded', function() {
                        const searchInput = document.getElementById('search');
                        searchInput.addEventListener('keypress', (e) => {
                            if (e.key === 'Enter') {
                                submitSearch();
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