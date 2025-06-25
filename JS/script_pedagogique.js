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

            
            if (targetFile === 'section_pedagogique') {
                fetchContent('section_pedagogique.php', target); 
            } else if (targetFile === 'DocumentEtudiant') {
                fetchContent('DocumentEtudiant.php', target); 
            }
        });
    });

    
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

        const one = document.getElementById("main-content");
        if (one) {
            const currentLeft = getComputedStyle(one).left;
            one.style.left = (currentLeft === "250px") ? "50px" : "250px";
        }
    });
}


function goBack() {
    const target = document.getElementById('main-content'); 

    
    if (target.dataset.loaded === 'section_pedagogique') {
        return; 
    }

    
    fetch('section_pedagogique.php')
        .then(response => {
            if (!response.ok) throw new Error('Failed to load content');
            return response.text();
        })
        .then(data => {
            target.innerHTML = data; 
            if (typeof initSidebarToggle === 'function') {
                initSidebarToggle();
            }

            target.dataset.loaded = 'section_pedagogique'; 
            
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