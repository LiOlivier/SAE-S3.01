<aside class="sidenav">
    <nav>
        <img src="../IMG/USPN.png" alt="logo USPN" id="USPN" class="bouton-side">
        <ul class="aside-ul">
            <li>
                <a href="board.php" class="bouton-side <?= basename($_SERVER['PHP_SELF']) == 'board.php' ? 'active' : '' ?>" id="TDB">
                    <div class="content-side">
                        <i class="fas fa-th" style="font-size: 1.3em;"></i>  <span>Tableau de
                            Bord</span>
                    </div>
                </a>
            </li>
            <li>

                <a href="document.php" class="bouton-side <?= basename($_SERVER['PHP_SELF']) == 'document.php' ? 'active' : '' ?>" id="DP">
                    <div class="content-side">
                        <i class="fas fa-folder" style="font-size: 1.3em;"></i> <span>Depot de document</span>
                    </div>
                </a>
            </li>
            <li>

                <a href="profil" class="bouton-side <?= basename($_SERVER['PHP_SELF']) == 'profil.php' ? 'active' : '' ?>" id="Profil">
                    <div class="content-side">
                        <i class="fas fa-users" style="font-size: 1.3em;"></i><span>Profil</span>
                    </div>

                </a>
            </li>
        </ul>
    </nav>
    <a href="login.php" class="bouton-side" id="Deconecter"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
</aside>