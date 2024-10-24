function changeMode(mode) {
    const lightMode = document.getElementById('light-mode');
    const darkMode = document.getElementById('dark-mode');
    if (mode === 'dark') {
        lightMode.disabled = true;
        darkMode.disabled = false;
        document.body.classList.remove('light-mode');
        document.body.classList.add('dark-mode');
    } else {
        lightMode.disabled = false;
        darkMode.disabled = true;
        document.body.classList.remove('dark-mode');
        document.body.classList.add('light-mode');
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