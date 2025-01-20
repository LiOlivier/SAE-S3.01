<aside class="sidenav">
    <button class="toggle-sidenav" id="toggleSidebar">
        <i class="fas fa-chevron-left"></i>
    </button>
    <nav>
        <img src="../IMG/USPN.png" alt="logo USPN" id="USPN" class="bouton-side">
        <ul class="aside-ul">
            
            <li>
                <a href="dashboard.php" class="bouton-side" id="TDB">
                    <div class="content-side">
                        <i class="fas fa-th" style="font-size: 1.3em;"></i> <span>Tableau de Bord</span>
                    </div>
                </a>
            </li>
            

            <li>
                <a href="etudiants.php" class="bouton-side" id="DP">
                    <div class="content-side">
                        <i class="fas fa-folder" style="font-size: 1.3em;"></i> <span>Liste des Etudiants</span>
                    </div>
                </a>
            </li>

            
            <li>
                <a href="stage-planning.php" class="bouton-side" id="Profil">
                    <div class="content-side">
                        <i class="fas fa-users" style="font-size: 1.3em;"></i><span>Stage-planning</span>
                    </div>
                </a>
            </li>
            
            
            <li>
                <a href="stages.php" class="bouton-side" id="DP">
                    <div class="content-side">
                        <i class="fas fa-folder" style="font-size: 1.3em;"></i> <span>Liste des stages</span>
                    </div>
                </a>
            </li>

            <li>
                <a href="tuteur.php" class="bouton-side" id="DP">
                    <div class="content-side">
                        <i class="fas fa-folder" style="font-size: 1.3em;"></i> <span>Tuteurs</span>
                    </div>
                </a>
            </li>

            
            <li>
                <a href="tuteurs-pedagogiques.php" class="bouton-side" id="DP">
                    <div class="content-side">
                        <i class="fas fa-folder" style="font-size: 1.3em;"></i> <span>Tuteurs Pedagogiques</span>
                    </div>
                </a>
            </li>

            <li>
                <a href="tuteurs-entreprise.php" class="bouton-side" id="DP">
                    <div class="content-side">
                        <i class="fas fa-folder" style="font-size: 1.3em;"></i> <span>Tuteurs Entreprise </span>
                    </div>
                </a>
            </li>
            
        
        </ul>
    </nav>
    <a href="login.php" class="bouton-side" id="Deconecter"><i class="fas fa-sign-out-alt" style="font-size: 1.3em;"></i><span> Déconnexion</span></a>
</aside>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#toggleSidebar').click(function() {
            $('.sidenav').toggleClass('collapsed');

            
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