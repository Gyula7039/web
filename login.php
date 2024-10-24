<?php
session_start();
require_once 'db_connect.php'; // Adatbázis kapcsolat

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lekérdezzük a felhasználót az adatbázisból
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // Felhasználó session beállítása
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Admin esetén irányítás az admin felületre
        if ($user['role'] === 'admin') {
            header("Location: admin.php");
        } else {
            header("Location: index2.php");
        }
        exit();
    } else {
        echo "Hibás felhasználónév vagy jelszó.";
    }
}
?>