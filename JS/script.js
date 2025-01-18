document.getElementById("arrow").addEventListener("click", function() {
    var english = document.getElementById("english");
    if (english.style.display === "none") {
        english.style.display = "block";
    } else {
        english.style.display = "none";
    }
});


var widthTDB = document.getElementById("body-tdb").getBoundingClientRect().width;
document.getElementById("body-tdb").style.width = widthTDB - 250 + "px";

let ajouteSemaine = document.getElementById("date-calendrier");

let semaine; // Déclare la variable pour les lignes de semaines
for (let i = 1; i <= 31; i++) {
    if (i % 7 == 1) { // Début d'une nouvelle semaine
        semaine = document.createElement('tr'); // Créer une nouvelle ligne
    }

    let day = document.createElement('td'); // Créer une cellule pour un jour
    day.textContent = i; // Ajouter le numéro du jour
    semaine.appendChild(day); // Ajouter le jour à la semaine

    if (i % 7 == 0 || i == 31) { // Fin de la semaine ou dernier jour
        ajouteSemaine.appendChild(semaine); // Ajouter la semaine au tableau
    }
}

let tailleBody = document.body.getBoundingClientRect();

document.getElementById('calendrier').style.left = (tailleBody.width - 380) + 'px';

let article = document.querySelector("article");
let widthArticle = article.getBoundingClientRect().width;


article.style.width=(widthArticle - 380) +"px";


//onglet notif



let notif = document.querySelector(".notification");
let xnotif = notif.getBoundingClientRect().x;
let ynotif = notif.getBoundingClientRect().bottom;

let ongletNotif = document.createElement("div");
ongletNotif.id="ongletNotif";
ongletNotif.style.position= "fixed";
ongletNotif.style.width = 280 +"px";
ongletNotif.style.height = 430 +"px";
ongletNotif.style.backgroundColor="white";
ongletNotif.textContent="heiiii";
document.body.querySelector("section").append(ongletNotif);
ongletNotif = document.getElementById("ongletNotif");
ongletNotif.style.left = (xnotif - 280) + "px";
ongletNotif.style.top = (ynotif) + "px";
ongletNotif.style.display="none";

notif.addEventListener('click',function(){
    if(notif.id == "notif"){
        notif.id = "remplir";
        notif.src="../img/icones/Notification-rempli.jpg";
    }

    else if (notif.id == "remplir"){
        notif.src="../img/icones/Notification-no-notif.jpg";
    }

    if(ongletNotif.style.display == "none"){
        ongletNotif.style.display = "block";
    }
    else{
        ongletNotif.style.display = "none";
    }
})





