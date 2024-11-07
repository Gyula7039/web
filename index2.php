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
    <div style="text-align:center">
  <h1 class="webcim">Számítógép részei</h1>
  <br>
  <img src="img/computer.png" alt="computer">
  <br>
  <ol style="text-align: center; list-style-type: none; list-style: none;">
    <li>1. monitor.</li>
    <li>2. alaplap.</li>
    <li>3. CPU (mikroprocesszor)</li>
    <li>4. elsődleges tárhely (RAM)</li>
    <li>5. videókártya, hangkártya.</li>
    <li>6. tápegység.</li>
    <li>7. optikai lemezmeghajtó</li>
    <li>8. másodlagos tárhely (merevlemez)</li>
  </ol>
  <br>
  <img src="img/IBM_PC_5150.jpg" alt="IBM" align="right">
  <div style="text-align: left">
  <p>A személyi számítógép (angolul: personal computer, PC) olyan számítógép,<br> amely nem egy központi számítógép terminálja (munkaállomása), hanem<br> önálló, egyetlen személy (az ún. végfelhasználó) által kezelt, kisebb méretű<br> gép saját billentyűzettel, processzorral, operatív memóriával és monitorral.<br> Létrehozásához a számítógép elektronikájának miniatürizálódása és<br> lényegesen kisebb előállítási költsége volt szükséges, ami a nyomtatott áramkörök és a mikroprocesszorok megjelenésével lett elérhető. Az<br> International Business Machines (IBM) 1981. augusztus 12-én mutatta az első<br> személyi számítógépét.</p>
  </div>
  <div style="text-align: right">
    Forrás: <a href="https://hu.wikipedia.org/wiki/Szem%C3%A9lyi_sz%C3%A1m%C3%ADt%C3%B3g%C3%A9p" target="_blank">Wikipédia-Személyi számítógép</a>
  </div>
</div>
</body>
</html>