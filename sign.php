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
 
    <?php
 
if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) ){
    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
 
    // ตั้งค่าการเชื่อมต่อฐานข้อมูล
    require_once 'connect.php';
 
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
 
    // ตรวจสอบ username ซ้ำ
    $stmt = $conn->prepare("SELECT user_id FROM user WHERE username = :username");
    $stmt->execute(array(':username' => $username));
 
    if ($stmt->rowCount() > 0) {
        echo '<script>
            setTimeout(function() {
                swal({
                    title: "Username ซ้ำ !! ",
                    text: "กรุณาสมัครใหม่อีกครั้ง",
                    type: "warning"
                }, function() {
                    window.location = "sign.php";
                });
            }, 1000);
        </script>';
    } else {
        // เข้ารหัสรหัสผ่านด้วย password_hash
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
 
        // บันทึกข้อมูลลงฐานข้อมูล
        $stmt = $conn->prepare("INSERT INTO user (username, email, password) VALUES (:username, :email, :password)");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR); //ใช้รหัสผ่านที่เข้ารหัสแล้ว
        $result = $stmt->execute();
 
        if($result) {
            echo '<script>
                setTimeout(function() {
                    swal({
                        title: "สมัครสมาชิกสำเร็จ",
                        text: "กรุณารอระบบ Login ใน Workshop ต่อไป",
                        type: "success"
                    }, function() {
                        window.location = "login.php";
                    });
                }, 1000);
            </script>';
        } else {
            echo '<script>
                setTimeout(function() {
                    swal({
                        title: "เกิดข้อผิดพลาด",
                        type: "error"
                    }, function() {
                        window.location = "formRegister.php";
                    });
                }, 1000);
            </script>';
        }
        $conn = null;
    }
}
 
?>
 
</body>
</html>