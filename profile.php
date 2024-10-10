<?php
include 'connect.php'; // เชื่อมต่อกับฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] == "POST") { // ตรวจสอบว่ามีการส่งข้อมูลด้วยวิธี POST
    $DadFirstname = $_POST['DadFirstname']; // ชื่อบิดา
    $DadLastname = $_POST['DadLastname']; // นามสกุลบิดา
    $DadAge = $_POST['DadAge']; // อายุบิดา
    $DadTel = $_POST['DadTel']; // เบอร์โทรบิดา

    $sql = "INSERT INTO info (DadFirstname, DadLastname, DadAge, DadTel)
            VALUES (:DadFirstname, :DadLastname, :DadAge, :DadTel)";

    $stmt = $conn->prepare($sql); // เตรียมคำสั่ง SQL

    // ผูกค่าตัวแปรกับคำสั่ง SQL
    $stmt->bindParam(':DadFirstname', $DadFirstname);
    $stmt->bindParam(':DadLastname', $DadLastname);
    $stmt->bindParam(':DadAge', $DadAge);
    $stmt->bindParam(':DadTel', $DadTel);
    
    

    if ($stmt->execute()) { // ถ้าสำเร็จ
        $last_id = $conn->lastInsertId(); // รับ ID ล่าสุดที่เพิ่มเข้าไป
        header("Location: main.php?id=$last_id"); // เปลี่ยนเส้นทางไปยังหน้า nutritional.php พร้อมกับ ID
        exit();
    } else {
        echo "Error inserting data."; // แสดงข้อความผิดพลาด
    }
}
?>


<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลเด็ก</title>
    <link rel="stylesheet" href="Css/info.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="info.js"></script>
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

    <div class="form-container">
    <h2>กรุณากรอกข้อมูลส่วนตัว</h2>
    <p>เพื่อเริ่มต้นการประเมินภาวะโภวชนาการ</p>
    <form action="" method="post" class="info-form" onsubmit="return validateForm()">
        <!-- Father Section -->
        <div class="section-title">ข้อมูลบิดา</div>
        <input type="text" name="DadFirstname" placeholder="ชื่อบิดา" required>
        <input type="text" name="DadLastname" placeholder="นามสกุลบิดา" required>
        <input type="number" name="DadAge" placeholder="อายุบิดา" required>
        <input type="tel" name="DadTel" placeholder="เบอร์โทรบิดา" required>

        

        <button type="submit" name = "sub" class = "sub">บันทึกข้อมูล</button>
    </form>
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

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</body>
</html>  