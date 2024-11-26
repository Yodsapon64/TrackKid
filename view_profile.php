<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM parent WHERE user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$parent = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$parent) {
    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โปรไฟล์ผู้ปกครอง</title>
    <link rel="stylesheet" href="Css/view_profile.css">
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

    
    <div class="profile-container">
        <h2>ข้อมูลโปรไฟล์ผู้ปกครอง</h2>
        <div class="profile-card">
            <p><strong>ชื่อ:</strong> <?php echo htmlspecialchars($parent['ParentFirstname']); ?></p>
            <p><strong>นามสกุล:</strong> <?php echo htmlspecialchars($parent['ParentLastname']); ?></p>
            <p><strong>สถานะ:</strong> <?php echo htmlspecialchars($parent['ParentStatus']); ?></p>
            <p><strong>อายุ:</strong> <?php echo htmlspecialchars($parent['ParentAge']); ?> ปี</p>
            <p><strong>เบอร์โทร:</strong> <?php echo htmlspecialchars($parent['ParentTel']); ?></p>
        </div>
        <a href="profile.php" class="edit-btn">แก้ไขข้อมูล</a>
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
