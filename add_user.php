<?php
session_start();

// Ellenőrizzük, hogy az admin van-e bejelentkezve
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

require_once 'db_connect.php'; // Adatbázis kapcsolat

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Adatok fogadása a POST-ból
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role']; // 'user' vagy 'admin'

    // Jelszó titkosítása
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Felhasználó beszúrása az adatbázisba
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);

    if ($stmt->execute()) {
        // Sikeres hozzáadás után átirányítás vissza az admin.php oldalra
        header("Location: admin.php");
    } else {
        echo "Hiba történt a felhasználó hozzáadása során: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
