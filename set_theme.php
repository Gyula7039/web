<?php
session_start();
require_once 'db_connect.php'; // Csatlakozás az adatbázishoz

// Ellenőrizzük, hogy a felhasználó be van-e jelentkezve
if (isset($_SESSION['username']) && isset($_POST['theme'])) {
    $username = $_SESSION['username'];
    $theme = $_POST['theme']; // A felhasználó által kiválasztott téma (light vagy dark)
    
    // Frissítjük a felhasználó témáját az adatbázisban
    $stmt = $conn->prepare("UPDATE users SET theme = ? WHERE username = ?");
    $stmt->bind_param('ss', $theme, $username);
    $stmt->execute();
    
    // Beállítjuk a session változót is a téma frissítéséhez
    $_SESSION['theme'] = $theme;
    
    // Vissza a főoldalra vagy bárhova
    header("Location: index.php");
    exit();
}
?>