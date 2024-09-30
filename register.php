<?php
$servername = "localhost"; // Változtasd meg, ha szükséges
$username = "root"; // Adatbázis felhasználónév
$password = ""; // Adatbázis jelszó
$dbname = "web";

// Kapcsolódás az adatbázishoz
$conn = new mysqli($servername, $username, $password, $dbname);

// Kapcsolat ellenőrzése
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Jelszó hashelése

    // Ellenőrzés és adatok beszúrása
    $stmt = $conn->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $username, $password);

    if ($stmt->execute()) {
        echo "Sikeres regisztráció!";
    } else {
        echo "Hiba: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>