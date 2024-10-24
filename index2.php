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

// Kiválasztjuk a megfelelő CSS fájlt
$stylesheet = ($theme === 'dark') ? 'style2.css' : 'style1.css';
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weblap</title>
    <link rel="stylesheet" href="<?php echo $stylesheet; ?>" id="theme-style">
    <link rel="stylesheet" href="desing.css"><!-- Design CSS -->
</head>
<body class="<?php echo $theme; ?>-mode">
    <h1>Válaszon témát</h1>
    <div class="form-group">
        <form action="set_theme.php" method="post">
            <label>
                <input type="radio" name="theme" value="light" <?php echo ($theme === 'light') ? 'checked' : ''; ?> onclick="this.form.submit()"> Világos mód
            </label>
            <label>
                <input type="radio" name="theme" value="dark" <?php echo ($theme === 'dark') ? 'checked' : ''; ?> onclick="this.form.submit()"> Sötét mód
            </label>
        </form>
    </div>

    <div class="container">
        <?php if ($is_logged_in): ?>
            <h2>Üdvözöljük, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
            <!-- Kijelentkezés gomb -->
            <form action="logout.php" method="post">
                <button type="submit">Kijelentkezés</button>
            </form>
        <?php else: ?>
            <!-- Bejelentkezési és regisztrációs formok itt -->
        <?php endif; ?>
    </div>

</body>
</html>
