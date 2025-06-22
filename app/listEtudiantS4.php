<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/listEtudiant.css">
</head>
<body>
<h4 id ="back" onclick="goBack()"><- Retour</h4>
<h1 id="titre-formation">Liste Etudiant</h1>

<?php require_once 'controller/info_card_chefdpt.php';
foreach ($listeS4 as $info) :?>
    <div class="listEtudiant" id="etudiant-<?=$info["id"]?>">
        <h3><?=$info["nom"]?> <?=$info["prenom"]?></h3>
        <p>BUT <?=$info["Libelle"]?></p>
        <button class="detail-button" 
            data-id="<?=$info["id"]?>" 
            data-nom="<?=$info["nom"]?>" 
            data-prenom="<?=$info["prenom"]?>" 
            data-departement="<?=$info["Libelle"]?>" 
            data-email="<?=$info["email"]?>" 
            data-telephone="<?=$info["telephone"]?>">Contacter</button>
    </div>
<?php endforeach?>
<script>document.addEventListener('DOMContentLoaded', function () {
    const mainContent = document.getElementById('main-content');

    mainContent.addEventListener('click', function (e) {
        if (e.target.classList.contains('detail-button')) {
            const id = e.target.getAttribute('data-id');
            const nom = e.target.getAttribute('data-nom');
            const prenom = e.target.getAttribute('data-prenom');
            const departement = e.target.getAttribute('data-departement');

            showModal(id, nom, prenom, departement);
        }
    });

    function showModal(id, nom, prenom, departement) {
        const modal = document.createElement('div');
        modal.classList.add('modal');
        modal.innerHTML = `
            <div class="modal-content">
                <span class="close-button">&times;</span>
                <h2>Student Details</h2>
                <p><strong>ID:</strong> ${id}</p>
                <p><strong>Name:</strong> ${nom} ${prenom}</p>
                <p><strong>Department:</strong> ${departement}</p>
            </div>
        `;

        document.body.appendChild(modal);

        modal.querySelector('.close-button').addEventListener('click', function () {
            document.body.removeChild(modal);
        });

        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                document.body.removeChild(modal);
            }
        });
    }
});</script>
</body>
</html>
