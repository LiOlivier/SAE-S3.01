<div class="card ">
    <div class="container">
        <div class="left">
            <div style="display: block;">
                <h3 class="nom depot-nom">Rapport</h3>
                <h4 class="date-limite"> Date limite : 12/01/2025</h4>
                <h4 class="etat"> Etat</h4>
                <div class="validation"> <i class="fas fa-circle" style="color: #63E6BE; margin:10px;"></i>Document Validé</div>

                <form id="uploadForm" enctype="multipart/form-data">
                    <button class="modele" type="button" onclick="window.location.href='../app/component/Download_Bordereau.php'">
                        Modèle <i class="fas fa-download load" style="color: #c0c0c0;"></i>
                    </button>
                    <input type="file" id="sortDocument" name="sortDocument" accept=".jpeg,.jpg,.png,.pdf" style="display:none;" />
                    <button type="button" class="joindre" onclick="document.getElementById('sortDocument').click()">
                        Joindre fichier <i class="fas fa-upload load" style="color: #c0c0c0;"></i>
                    </button>
                </form>

                <input type="hidden" value="email1@exemple.com">
                <div id="notification-container" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>
            </div>
        </div>
    </div>

</div>