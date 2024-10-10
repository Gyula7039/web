<?php
$servername = "localhost"; // A szerver neve vagy IP címe
$username = "root"; // A MySQL felhasználó neve
$password = ""; // A MySQL jelszó (alapértelmezésben üres XAMPP esetén)
$dbname = "web"; // Az adatbázis neve

// Kapcsolat létrehozása
$conn = new mysqli($servername, $username, $password, $dbname);

// Ellenőrizzük, hogy a kapcsolat sikeres-e
if ($conn->connect_error) {
    die("Kapcsolódási hiba: " . $conn->connect_error);
}
?>