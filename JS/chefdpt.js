var widthTDB = document.getElementById("body-tdb").getBoundingClientRect().width;
document.getElementById("body-tdb").style.width = widthTDB - 250 + "px";

let article = document.querySelector("article");
let widthArticle = article.getBoundingClientRect().width;


article.style.width=(widthArticle - 380) +"px";

document.addEventListener('DOMContentLoaded', function () {
    const blocks = document.querySelectorAll('.bloc-formation');

    blocks.forEach(block => {
        block.addEventListener('click', function (e) {
            e.preventDefault(); // Prevent default link behavior

            const target = document.getElementById('main-content');
            const targetFile = block.getAttribute('data-file');

            if (target.dataset.loaded === targetFile) {
                return;
            }

            if (targetFile === 'listEtudiantS4') {
                fetchContent('listEtudiantS4.php', target);
            } else if (targetFile === 'listEtudiantS6') {
                fetchContent('listEtudiantS6.php', target);
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
        })
        .catch(error => console.error('Error:', error));
}

function goBack() {
    window.location.reload();
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

