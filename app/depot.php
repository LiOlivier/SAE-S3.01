<?php
require "./controller/depotController.php";
$prenom = $_SESSION['user']['prenom'];

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Depôt des documents</title>
    <link rel="stylesheet" href="../CSS/aside.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/card.css">
    <link rel="stylesheet" href="../CSS/depot.css">
    <link rel="stylesheet" href="../CSS/t.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
        integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
</head>
<?php require_once(__DIR__ . "//component/header.php");
require_once(__DIR__ . "//component/aside.php"); ?>

<body class="body">
    <section id="one">

        <h1 id="titre">Document a déposer</h1>
        <div class="cards">
            <?php if ($actions) {
                foreach ($actions as $action) { ?>
                    <?php require "component/card_depot.php"; ?>
            <?php }
            } ?>
        </div>
        <?php require "component/notification.php"; ?>
    </section>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../JS/notif.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        
        $(".sortDocument").change(function() {
            let form = $(this).closest(".uploadForm"); 
            let formData = new FormData(form[0]); 

            $.ajax({
                url: "component/upload_handler.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "json"
            }).done(function(response) {
                console.log(response);

                if (response.status === "success") {
                    showNotification("Fichier téléchargé avec succès.");
                } else if (response.status === "error") {
                    showNotification("Erreur: " + response.message, 5000);
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR, textStatus, errorThrown);
                showNotification('Une erreur est survenue lors de l\'upload.', 5000);
            });
        });
    });
</script>

</html>