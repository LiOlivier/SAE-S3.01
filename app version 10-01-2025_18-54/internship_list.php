<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des stages - Responsable de Stage</title>
    <link rel="stylesheet" href="../CSS/aside.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/card.css">
    <link rel="stylesheet" href="../CSS/TBD.css">
    <link rel="stylesheet" href="../CSS/tableau.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
        integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
</head>
<?php require_once(__DIR__ . "//component/header.php");
require_once(__DIR__ . "//component/aside.php"); ?>

<body class="body">
    <section id="one">
        <h1 id="titre">Liste des stages</h1>
        <div class="cards">
            <table>
                <thead>
                    <tr>
                    <th>Nom de l'étudiant</th>
                    <th>Entreprise</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Statut</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Sherwin</td>
                    <td>Lipn</td>
                    <td>27/01/2025</td>
                    <td>30/04/2025</td>
                    <td>Rapport en attente</td>
                    <td><button>Voir les détails</button></td>
                </tr>
                <tr>
                    <td>Maxime</td>
                    <td>MS</td>
                    <td>15/01/2025</td>
                    <td>15/04/2025</td>
                    <td>Rapport en attente</td>
                    <td><button>Voir les détails</button></td>
                </tr>
                <tr>
                    <td>Denis</td> 
                    <td>MS</td> 
                    <td>15/01/2025</td> 
                    <td>15/04/2025</td> 
                    <td>Rapport en attente</td> 
                    <td><button>Voir les détails</button></td> 
                </tr> 
                <tr>
                    <td>Yassine</td> 
                    <td>MS</td> 
                    <td>15/01/2025</td> 
                    <td>15/04/2025</td> 
                    <td>Rapport en attente</td> 
                    <td><button>Voir les détails</button></td> 
                </tr> 
                <tr> 
                    <td>Huy</td> 
                    <td>MS</td> 
                    <td>15/01/2025</td> 
                    <td>15/04/2025</td> 
                    <td>Rapport en attente</td> 
                    <td><button>Voir les détails</button></td> 
                </tr> 
                <tr> 
                    <td>Olivier</td> 
                    <td>MS</td> 
                    <td>15/01/2025</td> 
                    <td>15/04/2025</td> 
                    <td>Rapport en attente</td> 
                    <td><button>Voir les détails</button></td> 
                </tr> 
                <tr> 
                    <td>Bharani</td> 
                    <td>MS</td> 
                    <td>15/01/2025</td> 
                    <td>15/04/2025</td> 
                    <td>Rapport en attente</td> 
                    <td><button>Voir les détails</button></td>
                </tr>
                </tbody>
            </table>
        </div>
        <?php require "component/notification.php" ?>
    </section>
</body>

</html>
<script src="../JS/notif.js"></script>