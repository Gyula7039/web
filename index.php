<?php
session_start(); // Session indítása

// Ellenőrizzük, hogy a felhasználó be van-e jelentkezve
$is_logged_in = isset($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weblap</title>
    <link rel="stylesheet" href="style1.css" id="light-mode"> <!-- Világos mód CSS -->
    <link rel="stylesheet" href="style2.css" id="dark-mode" disabled> <!-- Sötét mód CSS -->
    <link rel="stylesheet" href="desing.css"><!-- Desing CSS-->
</head>
<body class="light-mode">
    <h1>Válaszon témát</h1>
    <div class="form-group">
        <label>
            <input type="radio" name="mode" value="light" checked onclick="changeMode('light')"> Világos mód
        </label>
        <label>
            <input type="radio" name="mode" value="dark" onclick="changeMode('dark')"> Sötét mód
        </label>
    </div>

    <div class="container">
        <?php if ($is_logged_in): ?>
            <h2>Üdvözöljük, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
            <!-- Kijelentkezés gomb -->
            <form action="logout.php" method="post">
                <button type="submit">Kijelentkezés</button>
            </form>
        <?php else: ?>
            <div id="login-container" class="form-container">
                <h1>Bejelentkezés</h1>
                <form action="login.php" method="post" id="loginForm">
                    <div class="form-group">
                        <label for="loginUsername">Felhasználónév vagy E-mail:</label>
                        <input type="text" id="loginUsername" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="loginPassword">Jelszó:</label>
                        <input type="password" id="loginPassword" name="password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit">Bejelentkezés</button>
                    </div>
                    <p id="loginMessage" class="message"></p>
                </form>
                <p class="regist">Nem vagy még regisztrálva? <a href="#" onclick="toggleForms()">Regisztrálj itt</a></p>
            </div>

            <div id="register-container" class="form-container" style="display: none;">
                <h1>Regisztráció</h1>
                <form id="registerForm" action="register.php" method="post">
                    <div class="form-group">
                        <label for="registerEmail">E-mail:</label>
                        <input type="email" id="registerEmail" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="registerUsername">Felhasználónév:</label>
                        <input type="text" id="registerUsername" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="registerPassword">Jelszó:</label>
                        <input type="password" id="registerPassword" name="password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit">Regisztráció</button>
                    </div>
                    <p id="registerMessage" class="message"></p>
                </form>
                <p class="regist">Jelentkezz be a meglévő fiókoddal: <a href="#" onclick="toggleForms()">Bejelentkezés itt</a></p>
            </div>
        <?php endif; ?>
    </div>

    <script>
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
    </script>
</body>
</html>
