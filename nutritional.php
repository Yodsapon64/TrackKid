<?php
include 'connect.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id > 0) {
    $sql = "SELECT KidFirstname, KidLastname, KidBirth, 
            TIMESTAMPDIFF(YEAR, KidBirth, CURDATE()) AS Age, 
            KidGender, BloodType, Weight, KidHeight, Address, updated_at 
            FROM info WHERE id = :id";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $childInfo = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    $childInfo = null;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลภาวะโภชนาการ</title>
    <link rel="stylesheet" href="Css/nutritional.css">
</head>
<body>
    <div class="topbar">
        <div class="logo">
            <a href="main.php">เว็บแอปพลิเคชันสำหรับติดตามการเจริญเติบโตของเด็กอายุ 0-12 ปี</a>
        </div>
        <ul class="menu">
            <li><a href="main.php">หน้าหลัก</a></li>
            <li><a href="about2.php">เกี่ยวกับเรา</a></li>
            <li><a href="nutritional.php">ข้อมูลภาวะโภชนาการ</a></li>
            <li><a href="#">ข้อมูลวัคซีน</a></li>
            <li><a href="info.php">เพิ่มข้อมูลผู้ใช้งาน</a></li>
            <li><a href="logout.php" class="list-group-item list-group-item-danger" onclick="return confirm('ยืนยันการออกจากระบบ');">ออกจากระบบ</a></li>
        </ul>
    </div>

    <div class="content">
        <h2>ข้อมูลเด็ก</h2>
        <?php if ($childInfo): ?>
            <div class="child-info">
                <h3><?php echo htmlspecialchars($childInfo['KidFirstname'] . ' ' . $childInfo['KidLastname']); ?></h3>
                <p><strong>วันเกิด:</strong> <?php echo htmlspecialchars($childInfo['KidBirth']); ?></p>
                <p><strong>อายุ:</strong> <?php echo htmlspecialchars($childInfo['Age']); ?> ปี</p>
                <p><strong>เพศ:</strong> <?php echo htmlspecialchars($childInfo['KidGender']); ?></p>
                <p><strong>กรุ๊ปเลือด:</strong> <?php echo htmlspecialchars($childInfo['BloodType']); ?></p>
                <p><strong>น้ำหนัก:</strong> <?php echo htmlspecialchars($childInfo['Weight']); ?> กิโลกรัม</p>
                <p><strong>ส่วนสูง:</strong> <?php echo htmlspecialchars($childInfo['KidHeight']); ?> เซนติเมตร</p>
                <p><strong>ที่อยู่ปัจจุบัน:</strong> <?php echo htmlspecialchars($childInfo['Address']); ?></p>
                <p><strong>วันที่อัพเดตล่าสุด:</strong> <?php echo htmlspecialchars($childInfo['updated_at']); ?></p>
            </div>
        <?php else: ?>
            <p>ไม่พบข้อมูลเด็ก</p>
        <?php endif; ?>
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
</body>
</html>
