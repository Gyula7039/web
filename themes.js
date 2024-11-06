function changeMode(mode) {
    const body = document.getElementById('body');
    if (mode === 'dark') {
        body.classList.remove('bg-light', 'text-dark');
        body.classList.add('bg-dark', 'text-light');
    } else {
        body.classList.remove('bg-dark', 'text-light');
        body.classList.add('bg-light', 'text-dark');
    }
}

function toggleForms() {
    const loginContainer = document.getElementById('login-container');
    const registerContainer = document.getElementById('register-container');
    if (loginContainer.style.display === "none") {
        loginContainer.style.display = "block";
        registerContainer.style.display = "none";
    } else {
        loginContainer.style.display = "none";
        registerContainer.style.display = "block";
    }
}