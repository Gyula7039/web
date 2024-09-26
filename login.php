<?php
session_start();

$servername = "localhost"; // Változtasd meg, ha szükséges
$username = "your_username"; // Adatbázis felhasználónév
$password = "your_password"; // Adatbázis jelszó
$dbname = "my_database";

// Kapcsolódás az adatbázishoz
$conn = new mysqli($servername, $username, $password, $dbname);

// Kapcsolat ellenőrzése
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Adatok lekérdezése
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Jelszó ellenőrzése
        if (password_verify($password, $hashed_password)) {
            $_SESSION['username'] = $username; // Sikeres bejelentkezés
            echo "Sikeres bejelentkezés!";
        } else {
            echo "Hibás jelszó.";
        }
    } else {
        echo "Nincs ilyen felhasználónév.";
    }

    $stmt->close();
}

$conn->close();
?>