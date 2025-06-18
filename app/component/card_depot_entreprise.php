<?php foreach ($etudiantsActions as $etudiant): ?>
    <h2><?= htmlspecialchars($etudiant['prenom'] . ' ' . $etudiant['nom']) ?></h2>

    <?php foreach ($etudiant['actions'] as $action): ?>
    <div class="card">
        <div class="container">
            <div class="left">
                <div style="display: block;">
                    <h3 class="nom depot-nom"><?= $action["libelle"] ?></h3>
                    <h4 class="date-limite">Date limite : <?= $action["delai_limite"] ?></h4>
                    <h4 class="etat">État</h4>
                    <div class="validation">
                        <i class="fas fa-circle"
                            style="color: 
                            <?php
                            echo $action['Etat'] == 'A faire' ? '#B0B0B0' :
                                ($action['Etat'] == 'En attente' ? '#FFA500' :
                                    ($action['Etat'] == 'Valider' ? '#63E6BE' :
                                        ($action['Etat'] == 'Refuser' ? '#FF0000' : '#000000')));
                            ?>">
                        </i> <?= $action['Etat'] ?>
                    </div>

                    <?php if ($action['Etat'] != 'Valider') { ?>
                    <form class="uploadForm" enctype="multipart/form-data">
                        <button class="modele" type="button" onclick="window.location.href='../app/component/DownloadModel.php?idAction=<?= $action["id_type_action"] ?>'">
                            Modèle <i class="fas fa-download load" style="color: #c0c0c0;"></i>
                        </button>
                        <input type="file" class="sortDocument" name="sortDocument" accept=".jpeg,.jpg,.png,.pdf" style="display:none;" />
                        <input type="hidden" name="actionId" value="<?= $action["id_type_action"] ?>">
                        <input type="hidden" name="libelle" value="<?= $action["libelle"] ?>">
                        <input type="hidden" name="nom" value="<?= $_SESSION["user"]["nom"] ?>">
                        <?php if ($action['requiert_doc'] === 'oui') { ?>
                        <button type="button" class="contacter joindre" onclick="$(this).siblings('.sortDocument').click()">
                            Joindre fichier <i class="fas fa-upload load" style="color: #c0c0c0;"></i>
                        </button>
                        <?php } ?>
                    </form>
                    <?php } ?>

                    <?php if ($action['Etat'] === 'Valider') { ?>
                        <p class="message_valider">Document validé par l'administration</p>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
<?php endforeach; ?>
