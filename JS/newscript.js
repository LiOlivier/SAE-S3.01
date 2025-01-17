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
    const blocks = document.querySelectorAll('.bloc-formation'); // Get all the clickable blocks

    blocks.forEach(block => {
        block.addEventListener('click', function (e) {
            e.preventDefault(); // Prevent default link behavior

            const target = document.getElementById('main-content'); // Target container for dynamic content
            const targetFile = block.getAttribute('data-file'); // Get the target file to load

            // Check if the content is already loaded to avoid reloading the same content
            if (target.dataset.loaded === targetFile) {
                return; // Content already loaded, do nothing
            }

            // Load the corresponding PHP file dynamically based on the target
            if (targetFile === 'listEtudiant') {
                fetchContent('listEtudiant.php', target); // Fetch and load the student list
            } else if (targetFile === 'zoneFormation') {
                fetchContent('zoneFormation.php', target); // Fetch and load the zone formation content
            }
        });
    });
});

// Function to fetch content from the specified PHP file
function fetchContent(file, target) {
    fetch(file)
        .then(response => {
            if (!response.ok) throw new Error('Failed to load content');
            return response.text();
        })
        .then(data => {
            target.innerHTML = data; // Replace the content with the data from the PHP file
            target.dataset.loaded = file.split('.')[0]; // Mark as loaded based on the file name (without extension)
            
            // After loading new content, re-attach event listeners
            if (file === 'zoneFormation.php') {
                attachEventListeners(); // Re-attach event listeners to the blocs
            }
        })
        .catch(error => console.error('Error:', error));
}

// Function to go back to the original zoneFormation.php section
function goBack() {
    const target = document.getElementById('main-content'); // Target container for dynamic content
    
    // Reset the loaded data to allow reloading zoneFormation
    target.dataset.loaded = ''; // Reset the loaded attribute

    // Force reload of the zoneFormation.php content
    fetchContent('zoneFormation.php', target);
}

// Function to attach event listeners to the bloc-formation elements
function attachEventListeners() {
    const blocks = document.querySelectorAll('.bloc-formation'); // Get all the clickable blocks

    blocks.forEach(block => {
        block.addEventListener('click', function (e) {
            e.preventDefault(); // Prevent default link behavior

            const target = document.getElementById('main-content'); // Target container for dynamic content
            const targetFile = block.getAttribute('data-file'); // Get the target file to load

            // Check if the content is already loaded to avoid reloading the same content
            if (target.dataset.loaded === targetFile) {
                return; // Content already loaded, do nothing
            }

            // Load the corresponding PHP file dynamically based on the target
            if (targetFile === 'listEtudiant') {
                fetchContent('listEtudiant.php', target); // Fetch and load the student list
            } else if (targetFile === 'zoneFormation') {
                fetchContent('zoneFormation.php', target); // Fetch and load the zone formation content
            }
        });
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const mainContent = document.getElementById('main-content');

    // Listen for clicks on the "Contacter" buttons
    mainContent.addEventListener('click', function (e) {
        if (e.target.classList.contains('detail-button')) {
            // Extract student details from the button
            const id = e.target.getAttribute('data-id');
            const nom = e.target.getAttribute('data-nom');
            const prenom = e.target.getAttribute('data-prenom');
            const departement = e.target.getAttribute('data-departement');
            const email = e.target.getAttribute('data-email');
            const telephone = e.target.getAttribute('data-telephone');

            // Show the modal with the student's details
            showModal(id, nom, prenom, departement, email, telephone);
        }
    });

    // Function to show the modal
    function showModal(id, nom, prenom, departement, email, telephone) {
        // Create the modal content
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

        // Append the modal to the body
        document.body.appendChild(modal);

        // Close the modal when the "close" button is clicked
        modal.querySelector('.close-button').addEventListener('click', function () {
            document.body.removeChild(modal);
        });

        // Close the modal when clicking outside the modal content
        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                document.body.removeChild(modal);
            }
        });
    }
});

