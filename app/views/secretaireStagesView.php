<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des stages - Responsable de stage</title>
    <link rel="stylesheet" href="../CSS/aside.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/secretaire.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
        integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <style>
        .form-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px 32px;
            align-items: end;
            width: 100%;
            margin-bottom: 10px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            min-width: 0;
        }
        .form-button {
            display: flex;
            align-items: flex-end;
            min-width: 120px;
        }
        /* th, th a, th a:hover, th a:visited {
            color: #ffffff;
            text-decoration: none;
        } */
        /* th.common-sortable {
            cursor: pointer;
        }
        th.common-sortable:hover {
            background-color: #004080;
        } */
        /* .common-pagination {
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
        } */
    </style>
</head>
<body class="body">
    <?php 
        require_once(__DIR__ . "/../component/header.php");
        require_once(__DIR__ . "/../component/aside.php"); 
        // Default pagination values to prevent undefined errors
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $rowsPerPage = isset($_GET['rows']) && in_array((int)$_GET['rows'], [5, 10, 25, 50]) ? (int)$_GET['rows'] : 10;
        $totalPages = isset($totalPages) ? max(1, (int)$totalPages) : 1;
    ?>

    <div id="one">
        <h1 id="titre">Liste des stages</h1>
        <div class="cards">
            <div class="common-filter-section">
                <div class="common-filter-input">
                    <label for="search">Rechercher :</label>
                    <input type="text" id="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" placeholder="Nom étudiant/ville entreprise">
                </div>
                <div class="common-filter-input">
                    <label for="department">Département :</label>
                    <select id="department">
                        <option value="">Tous les départements</option>
                        <?php 
                        if (is_array($departments) && !empty($departments)) {
                            foreach ($departments as $dept) {
                                if (isset($dept['id_department']) && isset($dept['libelle'])) {
                                    echo '<option value="' . htmlspecialchars($dept['id_department']) . '" ' . 
                                         (isset($_GET['department']) && $_GET['department'] == $dept['id_department'] ? 'selected' : '') . '>' .
                                         htmlspecialchars($dept['libelle']) . '</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="common-filter-input">
                    <label for="year">Année :</label>
                    <select id="year">
                        <option value="">Toutes les années</option>
                        <?php foreach ($years as $year): ?>
                            <option value="<?= htmlspecialchars($year['annee']) ?>" <?= isset($_GET['year']) && $_GET['year'] == $year['annee'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($year['annee']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Stages Table -->
            <?php if (!empty($stages)): ?>
                <div class="table-wrapper">
                    <table class="responsive-table" id="stagesTable">
                        <thead>
                            <tr>
                                <th class="clickable-row" onclick="sortTable('student_name')">Étudiant ↑</th>
                                <th class="clickable-row" onclick="sortTable('company_name')">Ville entreprise</th>
                                <th>Tuteur pédagogique</th>
                                <th class="clickable-row" onclick="sortTable('date_debut')">Date de début</th>
                                <th class="clickable-row" onclick="sortTable('date_fin')">Date de fin</th>
                                <th>Mission</th>
                                <th>Date de soutenance</th>
                                <th>Salle</th>
                                <th>Second jury</th>
                                <th class="clickable-row" onclick="sortTable('overdue_actions')">Actions en retard</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <?php foreach ($stages as $stage): ?>
                                <tr>
                                    <td data-column="student_name"><?= htmlspecialchars($stage['student_name']) ?></td>
                                    <td data-column="company_name"><?= htmlspecialchars($stage['company_name'] ?? 'N/A') ?></td>
                                    <td data-column="academic_tutor_name"><?= htmlspecialchars($stage['academic_tutor_name'] ?? 'N/A') ?></td>
                                    <td data-column="date_debut"><?= htmlspecialchars($stage['date_debut']) ?></td>
                                    <td data-column="date_fin"><?= htmlspecialchars($stage['date_fin']) ?></td>
                                    <td data-column="mission"><?= htmlspecialchars($stage['mission']) ?></td>
                                    <td data-column="date_soutenance"><?= htmlspecialchars($stage['date_soutenance'] ?? 'Non planifiée') ?></td>
                                    <td data-column="salle_soutenance"><?= htmlspecialchars($stage['salle_soutenance'] ?? 'N/A') ?></td>
                                    <td data-column="second_jury_name"><?= htmlspecialchars($stage['second_jury_name'] ?? 'Non assigné') ?></td>
                                    <td data-column="overdue_actions" style="<?= $stage['overdue_actions'] > 0 ? 'color: #ff0000; font-weight: bold;' : '' ?>">
                                        <?= htmlspecialchars($stage['overdue_actions']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
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
                    const initialData = <?php echo json_encode($stages); ?>;
                    let currentData = [...initialData];

                    document.addEventListener('DOMContentLoaded', function() {
                        updateTable();
                    });

                    function updateTable() {
                        const search = document.getElementById('search').value.toLowerCase();
                        const department = document.getElementById('department').value;
                        const year = document.getElementById('year').value;
                        const tbody = document.getElementById('table-body');

                        // Filter data client-side
                        currentData = initialData.filter(stage => {
                            const matchesSearch = 
                                stage.student_name.toLowerCase().includes(search) ||
                                (stage.company_name?.toLowerCase().includes(search) ?? false);
                            const matchesDepartment = !department || stage.department_id == department;
                            const matchesYear = !year || stage.annee == year;

                            return matchesSearch && matchesDepartment && matchesYear;
                        });

                        // Update table body
                        tbody.innerHTML = '';
                        if (currentData.length === 0) {
                            tbody.innerHTML = '<tr><td colspan="10">Aucun stage trouvé.</td></tr>';
                        } else {
                            currentData.forEach(stage => {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                                    <td data-column="student_name">${escapeHtml(stage.student_name)}</td>
                                    <td data-column="company_name">${escapeHtml(stage.company_name ?? 'N/A')}</td>
                                    <td data-column="academic_tutor_name">${escapeHtml(stage.academic_tutor_name ?? 'N/A')}</td>
                                    <td data-column="date_debut">${escapeHtml(stage.date_debut)}</td>
                                    <td data-column="date_fin">${escapeHtml(stage.date_fin)}</td>
                                    <td data-column="mission">${escapeHtml(stage.mission)}</td>
                                    <td data-column="date_soutenance">${escapeHtml(stage.date_soutenance ?? 'Non planifiée')}</td>
                                    <td data-column="salle_soutenance">${escapeHtml(stage.salle_soutenance ?? 'N/A')}</td>
                                    <td data-column="second_jury_name">${escapeHtml(stage.second_jury_name ?? 'Non assigné')}</td>
                                    <td data-column="overdue_actions" style="${stage.overdue_actions > 0 ? 'color: #ff0000; font-weight: bold;' : ''}">
                                        ${escapeHtml(stage.overdue_actions)}
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

                    function sortTable(column) {
                        const table = document.getElementById('stagesTable');
                        const tbody = table.querySelector('tbody');
                        const rows = Array.from(tbody.querySelectorAll('tr'));
                        const header = table.querySelector(`th[onclick="sortTable('${column}')"]`);
                        const isAscending = header.textContent.includes('↑');
                        const sortOrder = isAscending ? -1 : 1;

                        table.querySelectorAll('th.clickable-row').forEach(th => {
                            const text = th.textContent.replace(/[↑↓]/g, '').trim();
                            th.textContent = text + (th === header ? (isAscending ? ' ↓' : ' ↑') : '');
                        });

                        rows.sort((a, b) => {
                            let aValue = a.querySelector(`td[data-column="${column}"]`).textContent.trim();
                            let bValue = b.querySelector(`td[data-column="${column}"]`).textContent.trim();

                            if (column === 'overdue_actions') {
                                aValue = parseInt(aValue) || 0;
                                bValue = parseInt(bValue) || 0;
                                return (aValue - bValue) * sortOrder;
                            }

                            if (column === 'date_debut' || column === 'date_fin') {
                                aValue = new Date(aValue);
                                bValue = new Date(bValue);
                                return (aValue - bValue) * sortOrder;
                            }

                            return aValue.localeCompare(bValue) * sortOrder;
                        });

                        tbody.innerHTML = '';
                        rows.forEach(row => tbody.appendChild(row));
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

                    document.getElementById('search').addEventListener('input', () => {
                        clearTimeout(window.searchTimeout);
                        window.searchTimeout = setTimeout(updateTable, 1000);
                    });

                    document.getElementById('department').addEventListener('change', updateTable);
                    document.getElementById('year').addEventListener('change', updateTable);
                </script>
            <?php else: ?>
                <p style="color: #ff0000;">Aucun stage trouvé.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>