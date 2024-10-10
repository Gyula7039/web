<?php
session_start();

// Ellenőrizzük, hogy az admin van-e bejelentkezve
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

require_once 'db_connect.php';

// Felhasználók listázása
$result = $conn->query("SELECT * FROM users");

// Törlés logika
if (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    header("Location: admin.php"); // Frissítjük az oldalt
}

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin felület</title>
</head>
<body>
    <h1>Adminisztrációs felület</h1>
    <h2>Felhasználók kezelése</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Felhasználónév</th>
            <th>Email</th>
            <th>Szerep</th>
            <th>Műveletek</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo $row['role']; ?></td>
                <td>
                    <form action="admin.php" method="post" style="display:inline;">
                        <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="delete_user">Törlés</button>
                    </form>
                    <!-- Módosítási űrlap -->
                    <a href="edit_user.php?id=<?php echo $row['id']; ?>">Módosítás</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h2>Új felhasználó hozzáadása</h2>
    <form action="add_user.php" method="post">
        <input type="text" name="username" placeholder="Felhasználónév" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Jelszó" required>
        <select name="role">
            <option value="user">Felhasználó</option>
            <option value="admin">Admin</option>
        </select>
        <button type="submit">Hozzáadás</button>
    </form>
</body>
</html>
