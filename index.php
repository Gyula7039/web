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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body class="bg-light text-dark" id="body">
    <h1>Válaszon témát</h1>
    <div class="form-group d-flex justify-content-center text-center my-4">
        <label class="mx-2">
            <input type="radio" name="mode" value="light" checked onclick="changeMode('light')"> Világos mód
        </label>
        <label class="mx-2">
            <input type="radio" name="mode" value="dark" onclick="changeMode('dark')"> Sötét mód
        </label>
    </div>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="row w-100">
        <div class="col-md-6 mx-auto">
            <?php if ($is_logged_in): ?>
                <h2 class="text-center">Üdvözöljük, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
                <form action="logout.php" method="post" class="text-center">
                    <button type="submit" class="btn btn-danger w-100">Kijelentkezés</button>
                </form>
            <?php else: ?>
                <div id="login-container" class="form-container text-center mx-auto">
                    <h1>Bejelentkezés</h1>
                    <form action="login.php" method="post" id="loginForm">
                        <div class="form-group">
                            <label for="loginUsername">Felhasználónév:</label>
                            <input type="text" id="loginUsername" name="username" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="loginPassword">Jelszó:</label>
                            <input type="password" id="loginPassword" name="password" required class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary w-100">Bejelentkezés</button>
                        </div>
                    </form>
                    <p class="regist">Nem vagy még regisztrálva? <a href="#" onclick="toggleForms()">Regisztrálj itt</a></p>
                </div>
                
                <div id="register-container" class="form-container text-center mx-auto" style="display: none;">
                    <h1>Regisztráció</h1>
                    <form id="registerForm" action="register.php" method="post">
                        <div class="form-group">
                            <label for="registerEmail">E-mail:</label>
                            <input type="email" id="registerEmail" name="email" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="registerUsername">Felhasználónév:</label>
                            <input type="text" id="registerUsername" name="username" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="registerPassword">Jelszó:</label>
                            <input type="password" id="registerPassword" name="password" required class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success w-100">Regisztráció</button>
                        </div>
                    </form>
                    <p class="regist">Jelentkezz be a meglévő fiókoddal: <a href="#" onclick="toggleForms()">Bejelentkezés itt</a></p>
                </div>
            <?php endif; ?>
            </div>
        </div>
    </div>


    
    <script>
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
    </script>
</body>
</html>