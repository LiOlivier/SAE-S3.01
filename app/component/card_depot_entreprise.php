<div class="card ">
    <div class="container">
        <div class="left">
            <div style="display: block;">
                <h3 class="nom depot-nom">Convention de</h3>
                <h4 class="date-limite"> Date limite : <?= $action["delai_limite"] ?></h4>
                <h4 class="etat"> Etat</h4>
                <div class="validation">
                    <i class="fas fa-circle"
                        style="color: 
        <?php
        echo $action['Etat'] == 'A faire' ? '#B0B0B0' : // Gris
            ($action['Etat'] == 'En attente' ? '#FFA500' : // Orange
                ($action['Etat'] == 'Valider' ? '#63E6BE' : // Vert
                    ($action['Etat'] == 'Refuser' ? '#FF0000' : '#000000'))); // Rouge par défaut, sinon Noir
        ?>">
                    </i> <?= $action['Etat'] ?>
                </div>

                <form class="uploadForm" enctype="multipart/form-data">
                <button class="modele" type="button" onclick="window.location.href='../app/component/DownloadModel.php?idAction=<?= $action["id_type_action"] ?>>
                        Modèle <i class="fas fa-download load" style="color: #c0c0c0;"></i>
                    </button>
                    <input type="file" class="sortDocument" name="sortDocument" accept=".jpeg,.jpg,.png,.pdf" style="display:none;" /> <!-- ID remplacé par une classe -->
                    <input type="hidden" name="actionId" value="<?= $action["id_type_action"] ?>">
                    <input type="hidden" name="libelle" value="<?= $action["libelle"] ?>">
                    <input type="hidden" name="nom" value="<?= $_SESSION["user"]["nom"] ?>">
                    <button type="button" class="contacter joindre" onclick="$(this).siblings('.sortDocument').click()"> <!-- Changez la logique pour utiliser siblings() -->
                        Joindre fichier<i class="fas fa-upload load" style="color: #c0c0c0;"></i>
                    </button>
                </form>

                <div id="notification-container" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>
            </div>

        </div>
    </div>

</div>

<div class="card ">
    <div class="container">
        <div class="left">
            <div style="display: block;">
                <h3 class="nom depot-nom">Rapport de stage</h3>
                <h4 class="date-limite"> Date limite : <?= $action["delai_limite"] ?></h4>
                <h4 class="etat"> Etat</h4>
                <div class="validation">
                    <i class="fas fa-circle"
                        style="color: 
        <?php
        echo $action['Etat'] == 'A faire' ? '#B0B0B0' : // Gris
            ($action['Etat'] == 'En attente' ? '#FFA500' : // Orange
                ($action['Etat'] == 'Valider' ? '#63E6BE' : // Vert
                    ($action['Etat'] == 'Refuser' ? '#FF0000' : '#000000'))); // Rouge par défaut, sinon Noir
        ?>">
                    </i> <?= $action['Etat'] ?>
                </div>

                <form class="uploadForm" enctype="multipart/form-data">
                <button class="modele" type="button" onclick="window.location.href='../app/component/DownloadModel.php?idAction=<?= $action["id_type_action"] ?>'">
                        Modèle <i class="fas fa-download load" style="color: #c0c0c0;"></i>
                    </button>
                    <input type="file" class="sortDocument" name="sortDocument" accept=".jpeg,.jpg,.png,.pdf" style="display:none;" /> <!-- ID remplacé par une classe -->
                    <input type="hidden" name="actionId" value="<?= $action["id_type_action"] ?>">
                    <input type="hidden" name="libelle" value="<?= $action["libelle"] ?>">
                    <input type="hidden" name="nom" value="<?= $_SESSION["user"]["nom"] ?>">
                    <button type="button" class="contacter joindre" onclick="$(this).siblings('.sortDocument').click()"> <!-- Changez la logique pour utiliser siblings() -->
                        Joindre fichier<i class="fas fa-upload load" style="color: #c0c0c0;"></i>
                    </button>
                </form>

                <div id="notification-container" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>
            </div>

        </div>
    </div>

</div>