<?php
// ตั้งค่าการเชื่อมต่อฐานข้อมูล (ปรับแต่งตามความต้องการของคุณ)
require_once 'connect.php';

// ตรวจสอบการส่งฟอร์ม
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // การเข้ารหัสรหัสผ่าน (เช่น bcrypt)
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // ตรวจสอบว่ามี username หรือ email ซ้ำในฐานข้อมูลหรือไม่
    $stmt = $conn->prepare("SELECT id FROM user WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);

    // ถ้า username หรือ email ซ้ำ
    if ($stmt->rowCount() > 0) {
        echo "<script>alert('Username หรือ Email ซ้ำ! กรุณาลองใหม่อีกครั้ง');</script>";
    } else {
        // SQL เพื่อบันทึกข้อมูลผู้ใช้
        $stmt = $conn->prepare("INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
        if ($stmt->execute([$username, $email, $hashed_password])) {
            echo "<script>alert('สมัครสมาชิกสำเร็จ!'); window.location.href = 'login.php';</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด: " . $stmt->errorInfo()[2] . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="Css/sign.css">
</head>
<body>
    <div class="topbar">
        <div class="logo">
            <a href="index.php">เว็บแอปพลิเคชันสำหรับติดตามการเจริญเติบโตของเด็กอายุ 0-12 ปี</a>
        </div>
        <ul class="menu">
            <li><a href="index.php">หน้าหลัก</a></li>
            <li><a href="about.php">เกี่ยวกับเรา</a></li>
        </ul>
    </div>

    <div class="signup-container">
        <div class="signup-card">
            <div class="signup-left">
                <img src="img/img4.jpg" alt="Sign Up Image">
            </div>
            <div class="signup-right">
                <h2>ลงทะเบียนสำหรับบัญชีใหม่</h2>
                <p>สมัครสมาชิกเพื่อรับสิทธิประโยชน์แก่บุตรหลานของท่าน</p>
                
                <form action="" method="post">
                    <input type="text" name="username" placeholder="ชื่อบัญชีของท่าน" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="รหัสผ่าน" required>
                    <button type="submit" class="signup-btn">สมัครสมาชิก</button>
                </form>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-container">
            <p>© 2024 เว็บแอปพลิเคชันสำหรับติดตามการเจริญเติบโตของเด็กอายุ 0-12 ปี. All rights reserved.</p>
            <ul class="footer-menu">
                <li><a href="privacy.html">Privacy Policy</a></li>
                <li><a href="terms.html">Terms of Service</a></li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>
        </div>
    </footer>
</body>
</html>
