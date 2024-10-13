<?php 
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Css/login.css">
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="login.js"></script>
    <title>Login Page</title>
</head>
<body>
    <!-- ส่วนของ HTML -->
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
    if(isset($_POST['username']) && isset($_POST['password']) ){
        require_once 'connect.php'; // ตรวจสอบให้แน่ใจว่ามีการเชื่อมต่อฐานข้อมูล

        $username = $_POST['username'];
        $password = $_POST['password'];

        // ตรวจสอบ username และ password
        $stmt = $conn->prepare("SELECT user_id, email, password FROM user WHERE username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        // ถ้าเจอ username ในฐานข้อมูล
        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // ตรวจสอบรหัสผ่าน
            if (password_verify($password, $row['password'])) {
                // สร้างตัวแปร session
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['username'] = $username;

                // เรียกใช้ฟังก์ชันแสดง alert สำหรับการเข้าสู่ระบบที่ถูกต้อง
                echo '<script>showSuccessAlert();</script>';
                exit();
            } else {
                // เรียกใช้ฟังก์ชันแสดง alert ถ้าเกิดข้อผิดพลาด
                echo '<script>showErrorAlert();</script>';
            }

            $conn = null; // ปิดการเชื่อมต่อฐานข้อมูล
        }
    }
    ?>
</body>
</html>
