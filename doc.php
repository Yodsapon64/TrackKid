<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'doctor') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าสำหรับเจ้าหน้าที่ทางการแพทย์</title>
</head>
<body>
    <h1>ยินดีต้อนรับ, <?php echo $_SESSION['username']; ?></h1>
    <p>นี่คือหน้าสำหรับเจ้าหน้าที่ทางการแพทย์</p>
</body>
</html>
