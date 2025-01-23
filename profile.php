<?php
session_start();
include 'connect.php'; 

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ParentFirstname = $_POST['ParentFirstname'];
    $ParentLastname = $_POST['ParentLastname'];
    $ParentStatus = $_POST['ParentStatus'];
    $ParentAge = $_POST['ParentAge'];
    $ParentTel = $_POST['ParentTel'];
    $user_id = $_SESSION['user_id'];

    $sql_check = "SELECT * FROM parent WHERE user_id = :user_id";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bindParam(':user_id', $user_id);
    $stmt_check->execute();

    if ($stmt_check->rowCount() > 0) {
        $sql = "UPDATE parent SET ParentFirstname = :ParentFirstname, ParentLastname = :ParentLastname, ParentStatus = :ParentStatus, ParentAge = :ParentAge, ParentTel = :ParentTel WHERE user_id = :user_id";
    } else {
        $sql = "INSERT INTO parent (user_id, ParentFirstname, ParentLastname, ParentStatus, ParentAge, ParentTel) VALUES (:user_id, :ParentFirstname, :ParentLastname, :ParentStatus, :ParentAge, :ParentTel)";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':ParentFirstname', $ParentFirstname);
    $stmt->bindParam(':ParentLastname', $ParentLastname);
    $stmt->bindParam(':ParentStatus', $ParentStatus);
    $stmt->bindParam(':ParentAge', $ParentAge);
    $stmt->bindParam(':ParentTel', $ParentTel);
    $stmt->bindParam(':user_id', $user_id);

    if ($stmt->execute()) {
        header("Location: view_profile.php");
        exit();
    } else {
        echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล";
    }
}
?>


<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการโปรไฟล์</title>
    <link rel="stylesheet" href="Css/info.css">
</head>
<body>
<div class="topbar">
        <div class="logo">
            <a href="main.php">เว็บแอปพลิเคชันสำหรับติดตามการเจริญเติบโตของเด็กอายุ 0-12 ปี</a>
        </div>
        <ul class="menu">
            <li><a href="main.php">หน้าหลัก</a></li>
            <li><a href="logout.php" onclick="return confirm('ยืนยันการออกจากระบบ');">ออกจากระบบ</a></li>
        </ul>
    </div>


    <div class="form-container">
        <h2>เพิ่ม/แก้ไขข้อมูลโปรไฟล์</h2>
        <form action="" method="post" class="info-form">
            <input type="text" name="ParentFirstname" placeholder="ชื่อ" required>
            <input type="text" name="ParentLastname" placeholder="นามสกุล" required>
            <select name="ParentStatus" required>
                <option value="">-- สถานะ --</option>
                <option value="บิดา">บิดา</option>
                <option value="มารดา">มารดา</option>
                <option value="ผู้ปกครอง">ผู้ปกครอง</option>
            </select>
            <input type="number" name="ParentAge" placeholder="อายุ" required>
            <input type="tel" name="ParentTel" placeholder="เบอร์โทร" required>
            <button type="submit" class="sub">บันทึกข้อมูล</button>
        </form>
    </div>

    <footer class="footer">
            <div class="footer-content">
                <div class="footer-section">
                    <h2>เกี่ยวกับเรา</h2>
                    <p>เว็บไซต์นี้ถูกพัฒนาขึ้นมาเพื่อให้ความรู้เกี่ยวกับ...</p>
                </div>
                <div class="footer-section">
                    <h2>ลิงก์ที่เป็นประโยชน์</h2>
                    <ul>
                        <li><a href="#">กรมอนามัย</a></li>
                        <li><a href="#">องค์การอนามัยโลก</a></li>
                        <li><a href="#">สมาคมกุมารแพทย์ไทย</a></li>
                    </ul>
                </div>
                <div class="footer-section contact-form">
                    <h2>ติดต่อเรา</h2>
                    <form action="contact.php" method="POST">
                        <input type="text" name="name" placeholder="ชื่อของคุณ">
                        <input type="email" name="email" placeholder="อีเมลของคุณ">
                        <textarea name="message" placeholder="ข้อความของคุณ"></textarea>
                        <button type="submit">ส่งข้อความ</button>
                    </form>
                </div>
            </div>
            <div class="footer-bottom">
                <p>Copyright &copy; 2024 - เว็บไซต์สุขภาพเด็ก</p>
            </div>
        </footer>
</body>
</html>
