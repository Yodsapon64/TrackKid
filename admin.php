<?php
// เริ่มต้นเซสชัน
session_start();

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือยัง
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    // ถ้าไม่ได้เป็นแอดมินหรือไม่ได้เข้าสู่ระบบ ให้เปลี่ยนเส้นทางไปหน้า login
    header("Location: login.php");
    exit();
}

// ข้อมูลตัวอย่าง (สามารถดึงจากฐานข้อมูล)
$users = [
    ['id' => 1, 'username' => 'user1', 'email' => 'user1@example.com', 'role' => 'user'],
    ['id' => 2, 'username' => 'user2', 'email' => 'user2@example.com', 'role' => 'admin'],
    ['id' => 3, 'username' => 'user3', 'email' => 'user3@example.com', 'role' => 'user']
];

?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="topbar">
        <div class="logo">
            <a href="#">Admin Panel</a>
        </div>
        <div class="menu">
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>

    <div class="content">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <p>Here is the list of registered users:</p>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <footer class="footer">
        <p>&copy; <?php echo date("Y"); ?> Admin Panel. All rights reserved.</p>
    </footer>
</body>
</html>
