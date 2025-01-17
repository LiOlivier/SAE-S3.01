<div class="card ">
    <div class="container">
        <div class="left">
            <div style="display: block;">
                <h3 class="nom depot-nom"><?= $action["libelle"] ?></h3>
                <h4 class="date-limite"> Date limite : <?= $action["dateLimite"] ?></h4>
                <h4 class="etat"> Etat</h4>
                <div class="validation"> <i class="fas fa-circle"
                        style="color: 
       <?php
        echo $action['Etat'] == 'A faire' ? '#B0B0B0' : // Gris
            ($action['Etat'] == 'En attente' ? '#FFA500' : // Orange
                ($action['Etat'] == 'Valider' ? '#63E6BE' : // Vert
                    ($action['Etat'] == 'Refuser' ? '#FF0000' : '#000000'))); // Rouge par défaut, sinon Noir
        ?>">
                    </i> </i> <?= $action['Etat'] ?></div>

                <form id="uploadForm" enctype="multipart/form-data">
                    <button class="contacter">
                        Modèle <i class="fas fa-download load" style="color: #c0c0c0;"></i>
                    </button>
                    <input type="file" id="sortDocument" name="sortDocument" accept=".jpeg,.jpg,.png,.pdf" style="display:none;" />
                    <button type="button" class="contacter joindre" onclick="document.getElementById('sortDocument').click()">
                        Joindre fichier<i class="fas fa-upload load" style="color: #c0c0c0;"></i>
                    </button>
                </form>

                <input type="hidden" value="email1@exemple.com">
                <div id="notification-container" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>
            </div>
        </div>
    </div>

</div>