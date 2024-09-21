<?php
include 'connect.php';

$id = $_GET['id'] ?? null;

if ($id) {
    // Fetch child information
    $stmt = $conn->prepare("SELECT * FROM info WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $childInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Calculate age
    if ($childInfo && isset($childInfo['KidBirth'])) {
        $birthDate = new DateTime($childInfo['KidBirth']);
        $today = new DateTime();
        $age = $today->diff($birthDate)->y; // คำนวณอายุเป็นปี
    } else {
        $age = null; // ถ้าไม่มีข้อมูลวันเกิด
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลภาวะโภชนาการ</title>
    <link rel="stylesheet" href="Css/nutritional.css">
    <script></script>
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

    <div class="info-container">
        <h2>ข้อมูลเด็ก</h2>
        <?php if ($childInfo): ?>
            <p><strong>ชื่อ:</strong> <?= htmlspecialchars($childInfo['KidFirstname']) ?> <?= htmlspecialchars($childInfo['KidLastname']) ?></p>
            <p><strong>วันเกิด:</strong> <?= htmlspecialchars((new DateTime($childInfo['KidBirth']))->format('d-m-Y')) ?></p>
            <p><strong>อายุ:</strong> <?= $age !== null ? htmlspecialchars($age) : 'ไม่ระบุ' ?> ปี</p>
            <p><strong>เพศ:</strong> <?= htmlspecialchars($childInfo['KidGender']) ?></p>
            <p><strong>ที่อยู่:</strong> <?= htmlspecialchars($childInfo['Address']) ?></p>
            <p><strong>กรุ๊ปเลือด:</strong> <?= htmlspecialchars($childInfo['BloodType']) ?></p>
            <p><strong>น้ำหนัก:</strong> <?= htmlspecialchars($childInfo['Weight']) ?> kg</p>
            <p><strong>ส่วนสูง:</strong> <?= htmlspecialchars($childInfo['KidHeight']) ?> cm</p>
        <?php else: ?>
            <p>ไม่พบข้อมูลเด็ก</p>
        <?php endif; ?>
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
