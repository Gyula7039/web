<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

// Ellenőrizzük, hogy POST metódussal érkezett-e az adat
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ellenőrizzük, hogy mindhárom mező be van-e küldve
    if (!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Jelszó hashelése

        // Ellenőrzés és adatok beszúrása az adatbázisba
        $stmt = $conn->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $username, $password);

        if ($stmt->execute()) {
            echo "Sikeres regisztráció!";
        } else {
            echo "Hiba történt: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Kérjük, töltse ki az összes mezőt!";
    }
}

$conn->close();
?>
