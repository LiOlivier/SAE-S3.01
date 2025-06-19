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

            
<<<<<<< HEAD
            if (targetFile === 'section_pedagogique') {
                fetchContent('section_pedagogique.php', target); 
=======
            if (targetFile === 'listEtudiant_pedagogique') {
                fetchContent('listEtudiant_pedagogique.php', target); 
>>>>>>> 145365576bb88050561c7ed14ad2574d84df58c3
            } else if (targetFile === 'DocumentEtudiant') {
                fetchContent('DocumentEtudiant.php', target); 
            }
        });
    });

    
<<<<<<< HEAD
    //document.getElementById('backButton').addEventListener('click', goBack);

    fetchContent('section_pedagogique.php', document.getElementById('main-content'));

});

function initSidebarToggle() {
    const toggleBtn = document.getElementById("toggleSidebar");
    if (!toggleBtn) return;

    toggleBtn.addEventListener("click", function () {
        const sidenav = document.querySelector(".sidenav");
        sidenav.classList.toggle("collapsed");

        const icon = this.querySelector("i");
        if (sidenav.classList.contains("collapsed")) {
            icon.classList.remove("fa-chevron-left");
            icon.classList.add("fa-chevron-right");
        } else {
            icon.classList.remove("fa-chevron-right");
            icon.classList.add("fa-chevron-left");
        }

        const one = document.getElementById("one");
        if (one) {
            const currentMargin = getComputedStyle(one).marginLeft;
            one.style.marginLeft = (currentMargin === "250px") ? "50px" : "250px";
        }
    });
}

=======
    document.getElementById('backButton').addEventListener('click', goBack);
});

>>>>>>> 145365576bb88050561c7ed14ad2574d84df58c3

function goBack() {
    const target = document.getElementById('main-content'); 

    
<<<<<<< HEAD
    if (target.dataset.loaded === 'section_pedagogique') {
=======
    if (target.dataset.loaded === 'listEtudiant_pedagogique') {
>>>>>>> 145365576bb88050561c7ed14ad2574d84df58c3
        return; 
    }

    
<<<<<<< HEAD
    fetch('section_pedagogique.php')
=======
    fetch('board_pedagogique.php')
>>>>>>> 145365576bb88050561c7ed14ad2574d84df58c3
        .then(response => {
            if (!response.ok) throw new Error('Failed to load content');
            return response.text();
        })
        .then(data => {
            target.innerHTML = data; 
<<<<<<< HEAD
            if (typeof initSidebarToggle === 'function') {
                initSidebarToggle();
            }

            target.dataset.loaded = 'section_pedagogique'; 
=======
            target.dataset.loaded = 'board_pedagogique'; 
>>>>>>> 145365576bb88050561c7ed14ad2574d84df58c3
            
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