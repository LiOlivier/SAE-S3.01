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