<aside class="sidenav">
    <button class="toggle-sidenav" id="toggleSidebar">
        <i class="fas fa-chevron-left"></i>
    </button>
    <nav>
        <img src="../IMG/USPN.png" alt="logo USPN" id="USPN" class="bouton-side">
        <ul class="aside-ul">
            <li>
                

            <?php if ($_SESSION["user"]["role"] == 'etudiant') { ?>
                        <a href="board.php" class="bouton-side" id="TDB">
                            <div class="content-side">
                                <i class="fas fa-th" style="font-size: 1.3em;"></i> <span>Tableau de Bord</span>
                            </div>
                        </a>
                    <?php } ?>
                    <?php if ($_SESSION["user"]["role"] == 'administrateur') { ?>
                        <a href="dpt.php" class="bouton-side" id="TDB">
                            <div class="content-side">
                                <i class="fas fa-th" style="font-size: 1.3em;"></i> <span>Tableau de Bord</span>
                            </div>
                        </a>
                    <?php } ?>
                    <?php if ($_SESSION["user"]["role"] == 'chefdept') { ?>
                        <a href="board_chefdpt_formation.php" class="bouton-side" id="TDB">
                            <div class="content-side">
                                <i class="fas fa-th" style="font-size: 1.3em;"></i> <span>Tableau de Bord</span>
                            </div>
                        </a>
                    <?php } ?>
                    <?php if ($_SESSION["user"]["role"] == 'tuteur') { ?>
                        <a href="board_entreprise.php" class="bouton-side" id="TDB">
                            <div class="content-side">
                                <i class="fas fa-th" style="font-size: 1.3em;"></i> <span>Tableau de Bord</span>
                            </div>
                        </a>
                    <?php } ?>

            </li>
            <li>
                <?php if ($_SESSION["user"]["role"] == 'etudiant') { ?>
                    <a href="depot.php" class="bouton-side" id="DP">
                        <div class="content-side">
                            <i class="fas fa-folder" style="font-size: 1.3em;"></i> <span>Dépot de document</span>
                        </div>
                    </a>
                <?php } ?>
                
            <?php if ($_SESSION["user"]["role"] == 'pedagogique') { ?>
                <a href="board_pedagogique.php" class="bouton-side" id="TDB">
                    <div class="content-side">
                        <i class="fas fa-th" style="font-size: 1.3em;"></i> <span>Tableau de Bord</span>
                    </div>
                </a>
            <?php } ?>

            </li>
            <li>
                <?php if ($_SESSION["user"]["role"] == 'etudiant') { ?>
                    <a href="depot.php" class="bouton-side" id="DP">
                        <div class="content-side">
                            <i class="fas fa-folder" style="font-size: 1.3em;"></i> <span>Dépot de document</span>
                        </div>
                    </a>
                <?php } ?>
            </li>

            <li>
                <?php if ($_SESSION["user"]["role"] == 'administrateur') { ?>
                    <a href="ajouter.php" class="bouton-side" id="DP">
                        <div class="content-side">
                            <i class="fas fa-folder" style="font-size: 1.3em;"></i> <span>Ajouter un utilisateur</span>
                        </div>
                    </a>
                <?php } ?>
            </li>


                <?php if ($_SESSION["user"]["role"] == 'secretaire') { ?>
                    <a href="dashboard.php" class="bouton-side" id="TDB">
                        <div class="content-side">
                            <i class="fas fa-th" style="font-size: 1.3em;"></i> <span>Tableau de Bord</span>
                        </div>
                        </a>
                    
                    <a href="etudiants.php" class="bouton-side" id="Etudiants">
                        <div class="content-side">
                            <i class="fas fa-users" style="font-size: 1.3em;"></i> <span>Étudiants</span>
                        </div>
                    </a>
                    <a href="stage-planning.php" class="bouton-side" id="StagePlanning">
                        <div class="content-side">
                            <i class="fas fa-calendar" style="font-size: 1.3em;"></i> <span>Planification des Stages</span>
                        </div>
                    </a>
                    <a href="stages.php" class="bouton-side" id="Stages">
                        <div class="content-side">
                            <i class="fas fa-briefcase" style="font-size: 1.3em;"></i> <span>Stages</span>
                        </div>
                    </a>
                    
                    <a href="tuteur.php" class="bouton-side" id="Tuteur">
                        <div class="content-side">
                            <i class="fas fa-chalkboard-teacher" style="font-size: 1.3em;"></i> <span>Tuteur</span>
                        </div>
                    </a>
                    <a href="tuteurs-entreprise.php" class="bouton-side" id="TuteursEntreprise">
                        <div class="content-side">
                            <i class="fas fa-building" style="font-size: 1.3em;"></i> <span>Tuteurs Entreprise</span>
                        </div>
                    </a>
                    <a href="tuteurs-pedagogiques.php" class="bouton-side" id="TuteursPedagogiques">
                        <div class="content-side">
                            <i class="fas fa-school" style="font-size: 1.3em;"></i> <span>Tuteurs Pédagogiques</span>
                        </div>
                    </a>
                <?php } ?>
            <li>

            <li>
                <a href="profil.php" class="bouton-side" id="Profil">
                    <div class="content-side">
                        <i class="fas fa-users" style="font-size: 1.3em;"></i><span>Profil</span>
                    </div>
                </a>
            </li>
        </ul>
    </nav>
    <a href="logout.php" class="bouton-side" id="Deconecter"><i class="fas fa-sign-out-alt" style="font-size: 1.3em;"></i><span> Déconnexion</span></a>
</aside>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#toggleSidebar').click(function() {
            $('.sidenav').toggleClass('collapsed');

            // Change the icon direction
            if ($('.sidenav').hasClass('collapsed')) {
                $(this).find('i').removeClass('fa-chevron-left').addClass('fa-chevron-right');
            } else {
                $(this).find('i').removeClass('fa-chevron-right').addClass('fa-chevron-left');
            }


        });
        $(document).ready(function() {
            $("#toggleSidebar").click(function() {
                var currentMargin = $("#one").css("margin-left");
                if (currentMargin == "250px") {
                    $("#one").css("margin-left", "50px");
                } else {
                    $("#one").css("margin-left", "250px");
                }
            });
        });
    });
</script>