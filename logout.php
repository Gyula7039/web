<?php
session_start(); // Session indítása

// Session törlése
session_unset();
session_destroy();

// Visszairányítás a bejelentkezési oldalra
header("Location: login.php");
exit();
?>