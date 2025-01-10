<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUT Informatique</title>
    <link rel="stylesheet" href="../CSS/aside.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/card.css">
    <link rel="stylesheet" href="../CSS/TBD.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
        integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <style>
        .student-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .student-card h3 {
            margin: 0;
            font-size: 18px;
        }

        .student-card p {
            margin: 5px 0 10px;
            color: #666;
        }

        .contact-button {
            background: #28a745;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .contact-button:hover {
            background: #218838;
        }

        .student-info {
            display: none;
            margin-top: 10px;
            padding: 10px;
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .close-info {
            float: right;
            cursor: pointer;
            font-size: 16px;
            color: #aaa;
        }

        .close-info:hover {
            color: #333;
        }
    </style>
</head>

<?php require_once(__DIR__ . "//component/header.php");
require_once(__DIR__ . "//component/aside.php");
?>

<body class="body">
    <section id="one">
        <h1 id="titre">Liste des élèves</h1>

        <div class="container">
            <!-- Élève 1 -->
            <div class="student-card">
                <h3>Denis Vuong</h3>
                <p>Formation: BUT2 Info - Groupe: Stymphale</p>
                <button class="contact-button" onclick="toggleInfo('info-denis')">Contacter</button>
                <div id="info-denis" class="student-info">
                    <span class="close-info" onclick="toggleInfo('info-denis')">&times;</span>
                    <p>Email: denis.vuong@example.com</p>
                    <p>Téléphone: 06 12 34 56 78</p>
                </div>
            </div>

            <!-- Élève 2 -->
            <div class="student-card">
                <h3>Maxime Lointier</h3>
                <p>Formation: BUT2 Info - Groupe: Stymphale</p>
                <button class="contact-button" onclick="toggleInfo('info-maxime')">Contacter</button>
                <div id="info-maxime" class="student-info">
                    <span class="close-info" onclick="toggleInfo('info-maxime')">&times;</span>
                    <p>Email: maxime.lointier@example.com</p>
                    <p>Téléphone: 06 23 45 67 89</p>
                </div>
            </div>

            <!-- Élève 3 -->
            <div class="student-card">
                <h3>Jorawar Singh Dulai</h3>
                <p>Formation: BUT2 Info - Groupe: Stymphale</p>
                <button class="contact-button" onclick="toggleInfo('info-jorawar')">Contacter</button>
                <div id="info-jorawar" class="student-info">
                    <span class="close-info" onclick="toggleInfo('info-jorawar')">&times;</span>
                    <p>Email: jorawar.singh@example.com</p>
                    <p>Téléphone: 06 34 56 78 90</p>
                </div>
            </div>
        </div>
    </section>

    <script>
        function toggleInfo(id) {
            const infoDiv = document.getElementById(id);
            if (infoDiv.style.display === 'none' || infoDiv.style.display === '') {
                infoDiv.style.display = 'block';
            } else {
                infoDiv.style.display = 'none';
            }
        }
    </script>
</body>

</html>
