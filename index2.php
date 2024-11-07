<?php
session_start();
require_once 'db_connect.php'; // Csatlakozás az adatbázishoz

// Ellenőrizzük, hogy a felhasználó be van-e jelentkezve
$is_logged_in = isset($_SESSION['username']);
$theme = 'light'; // Alapértelmezett téma

if ($is_logged_in) {
    $username = $_SESSION['username'];
    
    // Lekérjük a felhasználó témáját az adatbázisból
    $stmt = $conn->prepare("SELECT theme FROM users WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    // Beállítjuk a témát a session-ben és a változóban
    $theme = $user['theme'];
    $_SESSION['theme'] = $theme;
}

// Bootstrap osztály beállítása
$theme_class = ($theme === 'dark') ? 'bg-dark text-light' : 'bg-light text-dark';
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weblap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body class="<?php echo $theme_class; ?>">

    <div class="container">
        <h1>Válassz témát</h1>
        <form action="set_theme.php" method="post">
            <div class="form-group">
                <label>
                    <input type="radio" name="theme" value="light" <?php echo ($theme === 'light') ? 'checked' : ''; ?> onclick="this.form.submit()"> Világos mód
                </label>
                <label>
                    <input type="radio" name="theme" value="dark" <?php echo ($theme === 'dark') ? 'checked' : ''; ?> onclick="this.form.submit()"> Sötét mód
                </label>
            </div>
        </form>

        <?php if ($is_logged_in): ?>
            <h2>Üdvözlünk, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
            <form action="logout.php" method="post">
                <button type="submit" class="btn btn-danger">Kijelentkezés</button>
            </form>
        <?php else: ?>
            <!-- Bejelentkezési és regisztrációs formok itt -->
        <?php endif; ?>
    </div>
    <div>
        <h1 class="webcim">Számítógép részei</h1>
        <br>
        <img src="img/computer.png" alt="computer">
        <br>
        monitor.
        alaplap.
        CPU (mikroprocesszor)
        elsődleges tárhely (RAM)
        videókártya, hangkártya.
        tápegység.
        optikai lemezmeghajtó
        másodlagos tárhely (merevlemez)
    </div>
</body>
</html>