<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUT 2 Liste des élèves</title>
    <link rel="stylesheet" href="../CSS/aside.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: auto;
            margin-top: 50px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
            padding: 20px;
            position: relative;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: scale(1.03);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        .card h2 {
            margin: 0;
            font-size: 22px;
        }

        .card p {
            margin: 10px 0;
            color: #666;
        }

        .card .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        .card .btn:hover {
            background-color: #218838;
        }

        .info {
            display: none;
            padding: 15px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 10px;
            position: relative;
            animation: slideDown 0.3s ease-out;
        }

        .info.active {
            display: block;
        }

        .info .close {
            position: absolute;
            top: 5px;
            right: 10px;
            cursor: pointer;
            color: #888;
        }

        .info .close:hover {
            color: #555;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Liste des élèves</h1>

        <!-- Denis Vuong Card -->
        <div class="card">
            <h2>Denis Vuong</h2>
            <p>Formation: BUT2 Info - Groupe: Stymphale</p>
            <button class="btn" onclick="toggleInfo(this)">Contacter</button>
            <div class="info">
                <span class="close" onclick="closeInfo(this)">&times;</span>
                <p><strong>Email:</strong> denis.vuong@example.com</p>
                <p><strong>Téléphone:</strong> +33 6 12 34 56 78</p>
            </div>
        </div>

        <!-- Maxime Lointier Card -->
        <div class="card">
            <h2>Maxime Lointier</h2>
            <p>Formation: BUT2 Info - Groupe: Stymphale</p>
            <button class="btn" onclick="toggleInfo(this)">Contacter</button>
            <div class="info">
                <span class="close" onclick="closeInfo(this)">&times;</span>
                <p><strong>Email:</strong> maxime.lointier@example.com</p>
                <p><strong>Téléphone:</strong> +33 6 87 65 43 21</p>
            </div>
        </div>

        <!-- Jorawar Singh Dulai Card -->
        <div class="card">
            <h2>Jorawar Singh Dulai</h2>
            <p>Formation: BUT2 Info - Groupe: Stymphale</p>
            <button class="btn" onclick="toggleInfo(this)">Contacter</button>
            <div class="info">
                <span class="close" onclick="closeInfo(this)">&times;</span>
                <p><strong>Email:</strong> jorawar.singh@example.com</p>
                <p><strong>Téléphone:</strong> +33 7 89 45 67 12</p>
            </div>
        </div>
    </div>

    <script>
        // Function to toggle visibility of contact info
        function toggleInfo(button) {
            // Close all open info boxes
            document.querySelectorAll('.info.active').forEach(info => {
                info.classList.remove('active');
            });

            // Toggle the selected info box
            const info = button.nextElementSibling;
            info.classList.toggle('active');
        }

        // Function to close an info box
        function closeInfo(closeButton) {
            const info = closeButton.parentElement;
            info.classList.remove('active');
        }
    </script>
</body>

</html>
