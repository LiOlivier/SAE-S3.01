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

let semaine; 
for (let i = 1; i <= 31; i++) {
    if (i % 7 == 1) { 
        semaine = document.createElement('tr'); 
    }

    let day = document.createElement('td'); 
    day.textContent = i; 
    semaine.appendChild(day); 

    if (i % 7 == 0 || i == 31) { 
        ajouteSemaine.appendChild(semaine); 
    }
}

let tailleBody = document.body.getBoundingClientRect();

document.getElementById('calendrier').style.left = (tailleBody.width - 380) + 'px';

let article = document.querySelector("article");
let widthArticle = article.getBoundingClientRect().width;


article.style.width=(widthArticle - 380) +"px";






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
ongletNotif.style.left = (xnotif - 270) + "px";
ongletNotif.style.top = (ynotif) + "px";
ongletNotif.style.display="none";

notif.addEventListener('mousedown',remplaceNotif);


function remplaceNotif(){
    if(notif.id == "remplir"){
        console.log('non-remplir');
        notif.id = "non-remplir";
        notif.src="../img/icones/Notification-no-notif.jpg";
        ongletNotif.style.display = "none";
    }
    else{
        console.log("in remplir");
        notif.id = "remplir";
        notif.src="../img/icones/Notification-rempli.jpg";
        ongletNotif.style.display = "block";
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const blocks = document.querySelectorAll('.bloc-formation'); 

    blocks.forEach(block => {
        block.addEventListener('click', function (e) {
            e.preventDefault(); 

            const target = document.getElementById('main-content'); 
            const targetFile = block.getAttribute('data-file'); 

            
            if (target.dataset.loaded === targetFile) {
                return; 
            }

            
            if (targetFile === 'listEtudiantS4') {
                fetchContent('listEtudiantS4.php', target); 
            } else if (targetFile === 'listEtudiantS6') {
                fetchContent('listEtudiantS6.php', target); 
            } else if (targetFile === 'zoneFormation') {
                fetchContent('zoneFormation.php', target); 
            }
        });
    });
});


function fetchContent(file, target) {
    fetch(file)
        .then(response => {
            if (!response.ok) throw new Error('Failed to load content');
            return response.text();
        })
        .then(data => {
            target.innerHTML = data; 
            target.dataset.loaded = file.split('.')[0]; 
            
            
            if (file === 'zoneFormation.php') {
                attachEventListeners(); 
            }
        })
        .catch(error => console.error('Error:', error));
}


function goBack() {
    const target = document.getElementById('main-content'); 
    
    
    target.dataset.loaded = ''; 

    
    fetchContent('zoneFormation.php', target);
}


function attachEventListeners() {
    const blocks = document.querySelectorAll('.bloc-formation'); 

    blocks.forEach(block => {
        block.addEventListener('click', function (e) {
            e.preventDefault(); 

            const target = document.getElementById('main-content'); 
            const targetFile = block.getAttribute('data-file'); 

            
            if (target.dataset.loaded === targetFile) {
                return; 
            }

            
            if (targetFile === 'listEtudiantS4') {
                fetchContent('listEtudiantS4.php', target); 
            } else if (targetFile === 'listEtudiantS6') {
                fetchContent('listEtudiantS6.php', target); 
            } else if (targetFile === 'zoneFormation') {
                fetchContent('zoneFormation.php', target); 
            }
        });
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const mainContent = document.getElementById('main-content');

    
    mainContent.addEventListener('click', function (e) {
        if (e.target.classList.contains('detail-button')) {
            
            const id = e.target.getAttribute('data-id');
            const nom = e.target.getAttribute('data-nom');
            const prenom = e.target.getAttribute('data-prenom');
            const departement = e.target.getAttribute('data-departement');
            const email = e.target.getAttribute('data-email');
            const telephone = e.target.getAttribute('data-telephone');

            
            showModal(id, nom, prenom, departement, email, telephone);
        }
    });

    
    function showModal(id, nom, prenom, departement, email, telephone) {
        
        const modal = document.createElement('div');
        modal.classList.add('modal');
        modal.innerHTML = `
            <div class="modal-content">
                <span class="close-button">&times;</span>
                <h2>Information</h2>
                <p><strong>ID:</strong> ${id}</p>
                <p><strong>Name:</strong> ${nom} ${prenom}</p>
                <p><strong>Department:</strong> ${departement}</p>
                <p><strong>Email:</strong> <a href="mailto:${email}">${email}</a></p>
                <p><strong>Téléphone:</strong> <a href="tel:${telephone}">${telephone}</a></p>
            </div>
        `;

        
        document.body.appendChild(modal);

        
        modal.querySelector('.close-button').addEventListener('click', function () {
            document.body.removeChild(modal);
        });

        
        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                document.body.removeChild(modal);
            }
        });
    }
});

