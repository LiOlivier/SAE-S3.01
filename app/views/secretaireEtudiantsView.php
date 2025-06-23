<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Etudiants - Responsable de Stage</title>
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
        <h1 id="titre">Liste des Etudiants</h1>
        <div class="cards">
            <div class="common-filter-section">
                <div class="common-filter-input">
                    <label for="search">Rechercher :</label>
                    <input type="text" id="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Nom, Prénom, Email, Téléphone" onkeypress="if(event.key === 'Enter') updateQueryString()">
                    <button onclick="updateQueryString()">Rechercher</button>
                </div>
                <div class="common-filter-input">
                    <label for="department">Département :</label>
                    <select id="department" onchange="updateQueryString()">
                        <option value="">Tous</option>
                        <?php foreach ($departments as $dept): ?>
                            <option value="<?php echo $dept['id_departement']; ?>" <?php echo $department == $dept['id_departement'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($dept['libelle']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="common-filter-input">
                    <label for="semester">Semestre :</label>
                    <select id="semester" onchange="updateQueryString()">
                        <option value="">Tous</option>
                        <?php foreach ($semesters as $sem): ?>
                            <option value="<?php echo $sem; ?>" <?php echo $semester == $sem ? 'selected' : ''; ?>>
                                <?php echo $sem; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="common-filter-input">
                    <label for="year">Année :</label>
                    <select id="year" onchange="updateQueryString()">
                        <option value="">Tous</option>
                        <?php foreach ($years as $yr): ?>
                            <option value="<?php echo $yr; ?>" <?php echo $year == $yr ? 'selected' : ''; ?>>
                                <?php echo $yr; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="common-filter-input">
                    <label for="filter">Filtrer :</label>
                    <select id="filter" onchange="updateQueryString()">
                        <option value="all" <?php echo $filter === 'all' ? 'selected' : ''; ?>>Tous</option>
                        <option value="active" <?php echo $filter === 'active' ? 'selected' : ''; ?>>Actifs (en stage)</option>
                        <option value="inactive" <?php echo $filter === 'inactive' ? 'selected' : ''; ?>>Inactifs (pas en stage)</option>
                    </select>
                </div>
            </div>
            <button onclick="exportToCSV()">Exporter en CSV</button>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th class="clickable-row" onclick="sortTable('nom')">Nom <?php echo $sortColumn == 'nom' ? ($sortOrder == 'ASC' ? '↑' : '↓') : ''; ?></th>
                            <th class="clickable-row" onclick="sortTable('prenom')">Prénom <?php echo $sortColumn == 'prenom' ? ($sortOrder == 'ASC' ? '↑' : '↓') : ''; ?></th>
                            <th class="clickable-row" onclick="sortTable('email')">Email <?php echo $sortColumn == 'email' ? ($sortOrder == 'ASC' ? '↑' : '↓') : ''; ?></th>
                            <th class="clickable-row" onclick="sortTable('telephone')">Téléphone <?php echo $sortColumn == 'telephone' ? ($sortOrder == 'ASC' ? '↑' : '↓') : ''; ?></th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php if (empty($etudiants)): ?>
                            <tr><td colspan="4">Aucun étudiant trouvé.</td></tr>
                        <?php else: ?>
                            <?php foreach ($etudiants as $etudiant): ?>
                                <tr class="clickable-row" data-id="<?php echo $etudiant['id_etudiant']; ?>">
                                    <td><?php echo htmlspecialchars($etudiant['nom']); ?></td>
                                    <td><?php echo htmlspecialchars($etudiant['prenom']); ?></td>
                                    <td><?php echo htmlspecialchars($etudiant['email']); ?></td>
                                    <td><?php echo htmlspecialchars($etudiant['telephone']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
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
                document.addEventListener('DOMContentLoaded', function() {
                    attachRowClickEvents();
                });

                function attachRowClickEvents() {
                    var rows = document.querySelectorAll('.clickable-row');
                    rows.forEach(function(row) {
                        row.addEventListener('click', function(event) {
                            if (!event.target.closest('th.clickable-row')) {
                                var studentId = this.getAttribute('data-id');
                                window.location.href = 'secretaire-student-details.php?id=' + studentId;
                            }
                        });
                    });
                }

                function updateQueryString() {
                    const params = new URLSearchParams();
                    const search = document.getElementById('search').value;
                    const department = document.getElementById('department').value;
                    const semester = document.getElementById('semester').value;
                    const year = document.getElementById('year').value;
                    const filter = document.getElementById('filter').value;
                    const rows = document.getElementById('rowsPerPage').value;
                    const page = 1;

                    if (search) params.set('search', search);
                    if (department) params.set('department', department);
                    if (semester) params.set('semester', semester);
                    if (year) params.set('year', year);
                    if (filter) params.set('filter', filter);
                    params.set('rows', rows);
                    params.set('page', page);

                    window.location.href = '?' + params.toString();
                }

                function sortTable(column) {
                    const params = new URLSearchParams(window.location.search);
                    const currentSort = params.get('sort');
                    const currentOrder = params.get('order') || 'ASC';
                    const order = (currentSort === column && currentOrder === 'ASC') ? 'DESC' : 'ASC';
                    params.set('sort', column);
                    params.set('order', order);
                    const currentPage = params.get('page') || '<?php echo $page; ?>';
                    params.set('page', currentPage);
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

                function exportToCSV() {
                    const rows = document.querySelectorAll('table tr');
                    let csv = 'Nom,Prénom,Email,Téléphone\n';
                    rows.forEach((row, index) => {
                        if (index === 0) return;
                        const cols = row.querySelectorAll('td');
                        if (cols.length === 4) {
                            const rowData = Array.from(cols).map(col => `"${col.textContent.replace(/"/g, '""')}"`).join(',');
                            csv += rowData + '\n';
                        }
                    });
                    const blob = new Blob([csv], { type: 'text/csv' });
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = 'etudiants.csv';
                    a.click();
                    window.URL.revokeObjectURL(url);
                }

                document.getElementById('department').addEventListener('change', updateQueryString);
                document.getElementById('semester').addEventListener('change', updateQueryString);
                document.getElementById('year').addEventListener('change', updateQueryString);
                document.getElementById('filter').addEventListener('change', updateQueryString);
            </script>
        </div>
    </div>
</body>
</html>