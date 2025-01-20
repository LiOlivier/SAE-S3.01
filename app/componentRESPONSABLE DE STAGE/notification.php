<link rel="stylesheet" href="../CSS/notification.css">

<div class="panel">
    <h1 id="notif_title">Notification</h1>
    <div class="notifs">
        <div class="notif">
            <h1 class="titre_n">Bordereau de stage </h1>
            <div class="infor">Information precise</div>
            <div class="date_recu"> 19/02/2025</div>
        </div>
        <div class="notif">
            <h1 class="titre_n">Convention de stage </h1>
            <div class="infor">Information precise</div>
            <div class="date_recu"> 19/02/2025</div>
        </div>
        <div class="notif">
            <h1 class="titre_n">Soutenance de stage </h1>
            <div class="infor">Information precise</div>
            <div class="date_recu"> 19/02/2025</div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.fa-bell').click(function() {
            $('.panel').slideToggle('slow');
        });
    });
</script>