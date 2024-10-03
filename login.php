<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web";

// Kapcsolódás az adatbázishoz
$conn = new mysqli($servername, $username, $password, $dbname);

// Kapcsolat ellenőrzése
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ellenőrizzük, hogy a mezők léteznek és nem üresek
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Adatok lekérdezése az adatbázisból
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
    } else {
        echo "Kérjük, töltse ki az összes mezőt!";
    }
}

$conn->close();
?>