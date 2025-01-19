document.getElementById("arrow").addEventListener("click", function() {
    var english = document.getElementById("english");
    if (english.style.display === "none") {
        english.style.display = "block";
    } else {
        english.style.display = "none";
    }
});

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
            if (targetFile === 'listEtudiant_pedagogique') {
                fetchContent('listEtudiant_pedagogique.php', target); // Fetch and load the student list
            } else if (targetFile === 'DocumentEtudiant') {
                fetchContent('DocumentEtudiant.php', target); // Fetch and load the DocumentEtudiant content
            }
        });
    });

    // Event listener for back button
    document.getElementById('backButton').addEventListener('click', goBack);
});

// Function to go back to listEtudiant_pedagogique.php
function goBack() {
    const target = document.getElementById('main-content'); // Target container for dynamic content

    // Check if content is already loaded, if so, don't load again
    if (target.dataset.loaded === 'listEtudiant_pedagogique') {
        return; // Content already loaded, do nothing
    }

    // Load the listEtudiant_pedagogique.php file
    fetch('board_pedagogique.php')
        .then(response => {
            if (!response.ok) throw new Error('Failed to load content');
            return response.text();
        })
        .then(data => {
            target.innerHTML = data; // Replace the content with the data from listEtudiant_pedagogique.php
            target.dataset.loaded = 'board_pedagogique'; // Mark as loaded
            // Reattach any event listeners that may have been lost during content replacement
            attachEventListeners(); // Ensure event listeners for student divs are added back
        })
        .catch(error => console.error('Error:', error));
}

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
            // Reattach any event listeners for content loaded
            if (file === 'DocumentEtudiant.php') {
                attachEventListeners(); // Attach event listeners for the 'Contacter' buttons
            }
        })
        .catch(error => console.error('Error:', error));
}

// Function to attach event listeners to the new content dynamically
function attachEventListeners() {
    const studentDivs = document.querySelectorAll('.listEtudiant_pedagogique'); // Get all student divs

    studentDivs.forEach(div => {
        div.addEventListener('click', function (e) {
            const studentId = e.currentTarget.id.split('-')[1]; // Get student ID from div id
            loadDocumentEtudiant(studentId); // Load the document page for this student
        });
    });
}

// Function to load DocumentEtudiant.php dynamically with student info
function loadDocumentEtudiant(studentId) {
    const target = document.getElementById('main-content');
    fetch(`DocumentEtudiant.php?id=${studentId}`)
        .then(response => response.text())
        .then(data => {
            target.innerHTML = data; // Replace content with student details page
            target.dataset.loaded = 'DocumentEtudiant'; // Mark as loaded
            // Reattach the back button listener
            document.getElementById('backButton').addEventListener('click', goBack);
        })
        .catch(error => console.error('Error:', error));
}