document.getElementById("arrow").addEventListener("click", function() {
    var english = document.getElementById("english");
    if (english.style.display === "none") {
        english.style.display = "block";
    } else {
        english.style.display = "none";
    }
});

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

            
            if (targetFile === 'listEtudiant_pedagogique') {
                fetchContent('listEtudiant_pedagogique.php', target); 
            } else if (targetFile === 'DocumentEtudiant') {
                fetchContent('DocumentEtudiant.php', target); 
            }
        });
    });

    
    document.getElementById('backButton').addEventListener('click', goBack);
});


function goBack() {
    const target = document.getElementById('main-content'); 

    
    if (target.dataset.loaded === 'listEtudiant_pedagogique') {
        return; 
    }

    
    fetch('board_pedagogique.php')
        .then(response => {
            if (!response.ok) throw new Error('Failed to load content');
            return response.text();
        })
        .then(data => {
            target.innerHTML = data; 
            target.dataset.loaded = 'board_pedagogique'; 
            
            attachEventListeners(); 
        })
        .catch(error => console.error('Error:', error));
}


function fetchContent(file, target) {
    fetch(file)
        .then(response => {
            if (!response.ok) throw new Error('Failed to load content');
            return response.text();
        })
        .then(data => {
            target.innerHTML = data; 
            target.dataset.loaded = file.split('.')[0]; 
            
            if (file === 'DocumentEtudiant.php') {
                attachEventListeners(); 
            }
        })
        .catch(error => console.error('Error:', error));
}


function attachEventListeners() {
    const studentDivs = document.querySelectorAll('.listEtudiant_pedagogique'); 

    studentDivs.forEach(div => {
        div.addEventListener('click', function (e) {
            const studentId = e.currentTarget.id.split('-')[1]; 
            loadDocumentEtudiant(studentId); 
        });
    });
}


function loadDocumentEtudiant(studentId) {
    const target = document.getElementById('main-content');
    fetch(`DocumentEtudiant.php?id=${studentId}`)
        .then(response => response.text())
        .then(data => {
            target.innerHTML = data; 
            target.dataset.loaded = 'DocumentEtudiant'; 
            
            document.getElementById('backButton').addEventListener('click', goBack);
        })
        .catch(error => console.error('Error:', error));
}