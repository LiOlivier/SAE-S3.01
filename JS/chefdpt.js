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

let article = document.querySelector("article");
let widthArticle = article.getBoundingClientRect().width;


article.style.width=(widthArticle - 380) +"px";

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
            if (targetFile === 'listEtudiantS4') {
                fetchContent('listEtudiantS4.php', target); // Fetch and load the student list
            } else if (targetFile === 'listEtudiantS6') {
                fetchContent('listEtudiantS6.php', target); // Fetch and load the student list
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
        })
        .catch(error => console.error('Error:', error));
}

function goBack() {
    window.location.reload();
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
            if (targetFile === 'listEtudiantS4') {
                fetchContent('listEtudiantS4.php', target); // Fetch and load the student list
            } else if (targetFile === 'listEtudiantS6') {
                fetchContent('listEtudiantS6.php', target); // Fetch and load the student list
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

