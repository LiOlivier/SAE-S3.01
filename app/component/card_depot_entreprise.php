<div class="card">
    <div class="container">
        <div class="left">
            <div style="display: block;">
                <h3 class="nom depot-nom">Bordereau de Stage</h3>
                <h4 class="date-limite">Date Limite : <?= htmlspecialchars($bordereau['dateLimite'] ?? 'Non spécifiée') ?></h4>
                
                <?php if (!empty($bordereau['etat']) && $bordereau['etat'] === 'Valider' && !empty($bordereau['lien_document'])): ?>
                    <!-- Button for downloading the bordereau -->
                    <button class="contacter" style="background-color: #00244d; color: #fff; cursor: pointer;" 
                            onclick="window.location.href='<?= htmlspecialchars($bordereau['lien_document']) ?>'">
                        Télécharger <i class="fas fa-download load" style="color: #fff;"></i>
                    </button>
                <?php elseif (!empty($bordereau['etat']) && $bordereau['etat'] === 'En attente'): ?>
                    <!-- Button indicating the document is pending confirmation -->
                    <button class="contacter" style="background-color: #FFA500; color: #fff; cursor: not-allowed;" disabled>
                        En attente de confirmation
                    </button>
                <?php else: ?>
                    <!-- Disabled button when bordereau is not available -->
                    <button class="contacter" style="background-color: #B0B0B0; color: #fff; cursor: not-allowed;" disabled>
                        Non disponible
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<div class="card">
    <div class="container">
        <div class="left">
            <div style="display: block;">
                <h3 class="nom depot-nom">Convention de Stage</h3>
                <h4 class="date-limite">Date Limite : <?= htmlspecialchars($convention['dateLimite'] ?? 'Non spécifiée') ?></h4>
                
                <?php if ($convention['etat'] === 'Valider' && !empty($convention['lien_document'])): ?>
                    <!-- Button for downloading the convention -->
                    <button class="contacter" style="background-color: #00244d; color: #fff; cursor: pointer;" 
                            onclick="window.location.href='<?= htmlspecialchars($convention['lien_document']) ?>'">
                        Télécharger <i class="fas fa-download load" style="color: #fff;"></i>
                    </button>
                <?php elseif ($convention['etat'] === 'En attente'): ?>
                    <!-- Button indicating the document is pending confirmation -->
                    <button class="contacter" style="background-color: #FFA500; color: #fff; cursor: not-allowed;" disabled>
                        En attente de confirmation
                    </button>
                <?php else: ?>
                    <!-- Disabled button when convention is not available -->
                    <button class="contacter" style="background-color: #B0B0B0; color: #fff; cursor: not-allowed;" disabled>
                        Non disponible
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>