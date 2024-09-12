<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Css/login.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
    <script src="login.js" defer></script>
    <title>Login Page</title>
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

    <div class="login-container">
        <div class="login-card">
            <div class="login-left">
                <img src="img/img4.jpg" alt="Login Image">
            </div>
            <div class="login-right">
                <h2>ยินดีต้อนรับสู่เว็บไซต์ของเรา</h2>
                <p>โปรดเข้าสู่ระบบเพื่อเข้าใช้บริการของเว็บเรา</p>
                <form action="" method="post">
                    <input type="text" name="username" placeholder="ชื่อบัญชีของท่าน" required>
                    <input type="password" name="password" placeholder="รหัสผ่าน" required>
                    <button type="submit" class="login-btn">เข้าสู่ระบบ</button>
                    <button type="button" class="signup-btn" onclick="window.location.href='sign.php'">สมัครสมาชิก</button>
                    <p><a href="#">ท่านลืมรหัสผ่านหรือไม่?</a></p>
                </form>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-container">
            <p>© 2024 เว็บแอปพลิเคชันสำหรับติดตามการเจริญเติบโตของเด็กอายุ 0-12 ปี. All rights reserved.</p>
            <ul class="footer-menu">
                <li><a href="privacy.php">Privacy Policy</a></li>
                <li><a href="terms.php">Terms of Service</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </div>
    </footer>

    <?php
    // เชื่อมต่อฐานข้อมูล
    require_once 'connect.php';

    // ถ้ามีค่าส่งมาจากฟอร์ม
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
        // ประกาศตัวแปรรับค่าจากฟอร์ม
        $username = $_POST['username'];
        $password = $_POST['password'];

        // ตรวจสอบ username และ password
        $stmt = $conn->prepare("SELECT id, email, password FROM user WHERE username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        // ถ้าเจอ username ในฐานข้อมูล
        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // ตรวจสอบรหัสผ่าน
            if (password_verify($password, $row['password'])) {
                // สร้างตัวแปร session
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email'];

                // กระโดดไปหน้าหลัก
                header('Location: main.php');
                exit();
            } else {
                echo '<input type="hidden" id="messageType" value="warning">';
                echo '<input type="hidden" id="messageText" value="Password ไม่ถูกต้อง ลองใหม่อีกครั้ง">';
            }
        } else {
            echo '<input type="hidden" id="messageType" value="warning">';
            echo '<input type="hidden" id="messageText" value="Username หรือ Password ไม่ถูกต้อง ลองใหม่อีกครั้ง">';
        }
    }
    ?>
</body>
</html>
