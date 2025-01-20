<section id="body-tdb">
        <header><img src="../IMG/icones/Notification-notif.jpg" alt="" id="notif" class="notification" ></header>

        <div id="main-content">
            <?php include('zoneFormation.php'); ?> <!-- Default content initially loaded -->
        </div>
        <aside id="calendrier">
            <div id="mois">
                <span>&#8592</span><span id="nom-de-mois">Décembre</span><span>&#8594</span>
            </div>
            <table id="table-calendrier">
                <thead>
                    <tr>
                        <th>DIM</th>
                        <th>LUN</th>
                        <th>MAR</th>
                        <th>MER</th>
                        <th>JEU</th>
                        <th>VEN</th>
                        <th>SAM</th>
                    </tr>
                </thead>
                <tbody id="date-calendrier">
                </tbody>
            </table>
        </aside>
</section>