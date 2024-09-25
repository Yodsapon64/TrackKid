<?php
include 'connect.php'; // เชื่อมต่อกับฐานข้อมูล

// ตรวจสอบว่ามี id ถูกส่งผ่าน URL หรือไม่
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // คำสั่ง SQL เพื่อดึงข้อมูลจากฐานข้อมูล
    $sql = "SELECT * FROM info WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    // ดึงข้อมูลจากฐานข้อมูล
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // ตรวจสอบว่ามีข้อมูลหรือไม่
    if ($row) {
        $kidFirstname = $row['KidFirstname'];
        $kidLastname = $row['KidLastname'];
        $kidBirth = $row['KidBirth'];
        
        // คำนวณอายุจากวันเกิด
        $birthdate = new DateTime($kidBirth);
        $today = new DateTime('now');
        $age = $today->diff($birthdate)->y; // ใช้ diff คำนวณความแตกต่างเป็นจำนวนปี

        $kidGender = $row['KidGender'];
        $bloodType = $row['BloodType'];
        $weight = $row['Weight'];
        $height = $row['KidHeight'];
    } else {
        echo "ไม่พบข้อมูล";
        exit();
    }
} else {
    echo "ไม่มี ID ถูกส่งมา";
    exit();
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
    <h1>ข้อมูลส่วนตัวของเด็ก</h1>
    <div class="info-card">
        <p>ชื่อ: <?php echo htmlspecialchars($kidFirstname . ' ' . $kidLastname); ?></p>
        <p>วันเกิด: <?php echo htmlspecialchars($kidBirth); ?></p>
        <p>อายุ: <?php echo htmlspecialchars($age); ?> ปี</p>
        <p>เพศ: <?php echo htmlspecialchars($kidGender); ?></p>
        <p>กรุ๊ปเลือด: <?php echo htmlspecialchars($bloodType); ?></p>
        <p>น้ำหนัก: <?php echo htmlspecialchars($weight); ?> กิโลกรัม</p>
        <p>ส่วนสูง: <?php echo htmlspecialchars($height); ?> เซนติเมตร</p>
        <p>ข้อมูลอัปเดตล่าสุด: <?php echo htmlspecialchars($row['UpdateDate']); ?></p>
    </div>
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