document.addEventListener('DOMContentLoaded', function () {
    const togglePassword = document.getElementById('toggle-password');
    const togglePasswordConfirm = document.getElementById('toggle-password-confirm');
    const newPasswordInput = document.getElementById('new-mdp');
    const confirmPasswordInput = document.getElementById('confirm-mdp');
    const togglePasswordShow = document.getElementById('toggle-password-show');
    const togglePasswordShowConfirm = document.getElementById('toggle-password-show-confirm');

    togglePassword.addEventListener('click', function() {
        if (newPasswordInput.type === 'password') {
            newPasswordInput.type = 'text';
            togglePassword.src = '../IMG/icones/mdp.png';
            togglePasswordShow.style.display = 'block';
            togglePassword.style.display = 'none';
        } else {
            newPasswordInput.type = 'password';
            togglePassword.src = '../IMG/icones/mdp1.png';
            togglePasswordShow.style.display = 'none';
            togglePassword.style.display = 'block';
        }
    });

    togglePasswordConfirm.addEventListener('click', function() {
        if (confirmPasswordInput.type === 'password') {
            confirmPasswordInput.type = 'text';
            togglePasswordConfirm.src = '../IMG/icones/mdp.png';
            togglePasswordShowConfirm.style.display = 'block';
            togglePasswordConfirm.style.display = 'none';
        } else {
            confirmPasswordInput.type = 'password';
            togglePasswordConfirm.src = '../IMG/icones/mdp1.png';
            togglePasswordShowConfirm.style.display = 'none';
            togglePasswordConfirm.style.display = 'block';
        }
    });

    
    function disableCopyPaste(e) {
        e.preventDefault();
        alert("Le copier-coller est désactivé dans ce champ.");
    }

    
    newPasswordInput.addEventListener('copy', disableCopyPaste);
    newPasswordInput.addEventListener('paste', disableCopyPaste);
    confirmPasswordInput.addEventListener('copy', disableCopyPaste);
    confirmPasswordInput.addEventListener('paste', disableCopyPaste);

    
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && (e.key === 'c' || e.key === 'C')) {
            e.preventDefault();
            alert("Le copier-coller est désactivé dans ce champ.");
        }
    });
});
