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
            align-items: center;
        }
        .common-filter-section label {
            margin-right: 5px;
            font-weight: bold;
            color: #555;
            font-size: 0.9rem;
        }
        .common-filter-section select, .common-filter-section input[type="text"] {
            max-width: 200px;
            height: 34px;
            padding: 8px;
            border: 1px solid #003366;
            border-radius: 8px;
            font-size: 0.9rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .common-filter-section input:focus, .common-filter-section select:focus {
            border-color: #005599;
            box-shadow: 0 0 8px rgba(0, 53, 102, 0.3);
            outline: none;
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
        .common-export-btn {
            margin-bottom: 20px;
            padding: 8px 12px;
            background-color: #003366;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background-color 0.3s ease;
        }
        .common-export-btn:hover {
            background-color: #005599;
        }
    </style>
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
                    <input type="text" id="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Nom, Prénom, Email, Téléphone">
                </div>
                <div class="common-filter-input">
                    <label for="department">Département :</label>
                    <select id="department">
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
                    <select id="semester">
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
                    <select id="year">
                        <option value="">Tous</option>
                        <?php foreach ($years as $yr): ?>
                            <option value="<?php echo $yr; ?>" <?php echo $year == $yr ? 'selected' : ''; ?>>
                                <?php echo $yr; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <button class="common-export-btn" onclick="exportToCSV()">Exporter en CSV</button>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th class="common-sortable" onclick="sortTable('nom')">Nom <?php echo $sortColumn == 'nom' ? ($sortOrder == 'ASC' ? '↑' : '↓') : ''; ?></th>
                            <th class="common-sortable" onclick="sortTable('prenom')">Prénom <?php echo $sortColumn == 'prenom' ? ($sortOrder == 'ASC' ? '↑' : '↓') : ''; ?></th>
                            <th class="common-sortable" onclick="sortTable('email')">Email <?php echo $sortColumn == 'email' ? ($sortOrder == 'ASC' ? '↑' : '↓') : ''; ?></th>
                            <th class="common-sortable" onclick="sortTable('telephone')">Téléphone <?php echo $sortColumn == 'telephone' ? ($sortOrder == 'ASC' ? '↑' : '↓') : ''; ?></th>
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
                // Store initial data from PHP
                const initialData = <?php echo json_encode($etudiants); ?>;
                let currentData = [...initialData];

                document.addEventListener('DOMContentLoaded', function() {
                    attachRowClickEvents();
                });

                function attachRowClickEvents() {
                    var rows = document.querySelectorAll('.clickable-row');
                    rows.forEach(function(row) {
                        row.addEventListener('click', function(event) {
                            if (!event.target.closest('th.common-sortable')) {
                                var studentId = this.getAttribute('data-id');
                                window.location.href = 'secretaire-student-details.php?id=' + studentId;
                            }
                        });
                    });
                }

                function updateTable() {
                    const search = document.getElementById('search').value.toLowerCase();
                    const tbody = document.getElementById('table-body');

                    // Filter data client-side
                    currentData = initialData.filter(etudiant => {
                        return (
                            etudiant.nom.toLowerCase().includes(search) ||
                            etudiant.prenom.toLowerCase().includes(search) ||
                            etudiant.email.toLowerCase().includes(search) ||
                            etudiant.telephone.toLowerCase().includes(search)
                        );
                    });

                    // Update table body
                    tbody.innerHTML = '';
                    if (currentData.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="4">Aucun étudiant trouvé.</td></tr>';
                    } else {
                        currentData.forEach(etudiant => {
                            const row = document.createElement('tr');
                            row.className = 'clickable-row';
                            row.setAttribute('data-id', etudiant.id_etudiant);
                            row.innerHTML = `
                                <td>${escapeHtml(etudiant.nom)}</td>
                                <td>${escapeHtml(etudiant.prenom)}</td>
                                <td>${escapeHtml(etudiant.email)}</td>
                                <td>${escapeHtml(etudiant.telephone)}</td>
                            `;
                            tbody.appendChild(row);
                        });
                    }
                    attachRowClickEvents();
                }

                function escapeHtml(str) {
                    const div = document.createElement('div');
                    div.textContent = str;
                    return div.innerHTML;
                }

                function updateQueryString() {
                    const params = new URLSearchParams();
                    const search = document.getElementById('search').value;
                    const department = document.getElementById('department').value;
                    const semester = document.getElementById('semester').value;
                    const year = document.getElementById('year').value;
                    const rows = document.getElementById('rowsPerPage').value;
                    const page = <?php echo $page; ?>;
                    const sort = '<?php echo $sortColumn; ?>';
                    const order = '<?php echo $sortOrder; ?>';

                    if (search) params.set('search', search);
                    if (department) params.set('department', department);
                    if (semester) params.set('semester', semester);
                    if (year) params.set('year', year);
                    params.set('rows', rows);
                    params.set('page', page);
                    params.set('sort', sort);
                    params.set('order', order);

                    window.location.href = '?' + params.toString();
                }

                function sortTable(column) {
                    const currentSort = '<?php echo $sortColumn; ?>';
                    const currentOrder = '<?php echo $sortOrder; ?>';
                    const order = (column === currentSort && currentOrder === 'ASC') ? 'DESC' : 'ASC';
                    const params = new URLSearchParams(window.location.search);
                    params.set('sort', column);
                    params.set('order', order);
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

                function exportToCSV() {
                    const rows = document.querySelectorAll('table tr');
                    let csv = 'Nom,Prénom,Email,Téléphone\n';
                    rows.forEach((row, index) => {
                        if (index === 0) return; // Skip header
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

                document.getElementById('search').addEventListener('input', () => {
                    clearTimeout(window.searchTimeout);
                    window.searchTimeout = setTimeout(updateTable, 1000);
                });

                document.getElementById('department').addEventListener('change', updateQueryString);
                document.getElementById('semester').addEventListener('change', updateQueryString);
                document.getElementById('year').addEventListener('change', updateQueryString);
            </script>
        </div>
    </div>
</body>
</html>