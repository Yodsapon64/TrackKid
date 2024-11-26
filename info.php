<?php
session_start(); 

include 'connect.php'; // เชื่อมต่อกับฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] == "POST") { // ตรวจสอบว่ามีการส่งข้อมูลด้วยวิธี POST
    $DadFirstname = $_POST['DadFirstname']; // ชื่อบิดา
    $DadLastname = $_POST['DadLastname']; // นามสกุลบิดา
    $DadAge = $_POST['DadAge']; // อายุบิดา
    $DadTel = $_POST['DadTel']; // เบอร์โทรบิดา
    
    $MomFirstname = $_POST['MomFirstname']; // ชื่อมารดา
    $MomLastname = $_POST['MomLastname']; // นามสกุลมารดา
    $MomAge = $_POST['MomAge']; // อายุมารดา
    $MomTel = $_POST['MomTel']; // เบอร์โทรมารดา
    
    $KidFirstname = $_POST['KidFirstname']; // ชื่อเด็ก
    $KidLastname = $_POST['KidLastname']; // นามสกุลเด็ก
    $KidBirth = $_POST['KidBirth']; // วันเกิดเด็ก
    $KidAge  = $_POST['KidAge']; // อายุเด็ก
    $KidGender = $_POST['KidGender']; // เพศเด็ก
    $Address = $_POST['Address']; // ที่อยู่
    $BloodType = $_POST['BloodType']; // กรุ๊ปเลือด
    $Weight = $_POST['Weight']; // น้ำหนัก
    $KidHeight = $_POST['KidHeight']; // ส่วนสูง
    $user_id = $_POST['user_id']; // ส่วนสูง

    $updateDate = date('Y-m-d H:i:s'); // รับวันที่ปัจจุบัน

    // ปรับปรุง SQL คำสั่ง โดยใช้ตัวแปรที่ถูกต้อง
    $sql = "INSERT INTO info (user_id, DadFirstname, DadLastname, DadAge, DadTel, MomFirstname, MomLastname, MomAge, MomTel, KidFirstname, KidLastname, KidBirth, KidAge, KidGender, Address, BloodType, Weight, KidHeight, UpdateDate)
            VALUES (:user_id, :DadFirstname, :DadLastname, :DadAge, :DadTel, :MomFirstname, :MomLastname, :MomAge, :MomTel, :KidFirstname, :KidLastname, :KidBirth, :KidAge, :KidGender, :Address, :BloodType, :Weight, :KidHeight, :UpdateDate)";

    $stmt = $conn->prepare($sql); // เตรียมคำสั่ง SQL

    // ผูกค่าตัวแปรกับคำสั่ง SQL
    $stmt->bindParam(':DadFirstname', $DadFirstname);
    $stmt->bindParam(':DadLastname', $DadLastname);
    $stmt->bindParam(':DadAge', $DadAge);
    $stmt->bindParam(':DadTel', $DadTel);
    $stmt->bindParam(':MomFirstname', $MomFirstname);
    $stmt->bindParam(':MomLastname', $MomLastname);
    $stmt->bindParam(':MomAge', $MomAge);
    $stmt->bindParam(':MomTel', $MomTel);
    $stmt->bindParam(':KidFirstname', $KidFirstname);
    $stmt->bindParam(':KidLastname', $KidLastname);
    $stmt->bindParam(':KidBirth', $KidBirth);
    $stmt->bindParam(':KidAge', $KidAge);
    $stmt->bindParam(':KidGender', $KidGender);
    $stmt->bindParam(':Address', $Address);
    $stmt->bindParam(':BloodType', $BloodType);
    $stmt->bindParam(':Weight', $Weight);
    $stmt->bindParam(':KidHeight', $KidHeight);
    $stmt->bindParam(':UpdateDate', $updateDate); // เพิ่มการผูก UpdateDate ด้วย
    $stmt->bindParam(':user_id', $_SESSION['user_id']); 

    if ($stmt->execute()) { // ถ้าสำเร็จ
        $last_id = $conn->lastInsertId(); // รับ ID ล่าสุดที่เพิ่มเข้าไป
        $_SESSION['last_id'] = $last_id;
        echo "<script>alert('บันทึกข้อมูลสำเร็จ');</script>";
        header("Location: nutritional.php"); // เปลี่ยนเส้นทางไปยังหน้า nutritional.php พร้อมกับ ID
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
                <li><a href="profile.php">ยินดีต้อนรับ <?php echo $_SESSION['username']; ?></a></li>
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

        <!-- Mother Section -->
        <div class="section-title">ข้อมูลมารดา</div>
        <input type="text" name="MomFirstname" placeholder="ชื่อมารดา" required>
        <input type="text" name="MomLastname" placeholder="นามสกุลมารดา" required>
        <input type="number" name="MomAge" placeholder="อายุมารดา" required>
        <input type="tel" name="MomTel" placeholder="เบอร์โทรมารดา" required>

        <!-- Child Section -->
        <div class="section-title">ข้อมูลเด็ก</div>
        <input type="text" name="KidFirstname" placeholder="ชื่อเด็ก" required>
        <input type="text" name="KidLastname" placeholder="นามสกุลเด็ก" required>
        <input type="date" id="kidBirth" name="KidBirth" placeholder="วันเกิดเด็ก" class="full-width" required>
        <input type="number" name="KidAge" id="KidAge" placeholder="อายุเด็ก" required>
        
        <label for="KidGender" class="full-width">เพศของเด็ก</label>
        <div class="gender-toggle">
            <input type="radio" id="kidMale" name="KidGender" value="ชาย">
            <label for="kidMale" class="gender-label male">ชาย</label>
            <input type="radio" id="kidFemale" name="KidGender" value="หญิง">
            <label for="kidFemale" class="gender-label female">หญิง</label>
        </div>

        <textarea id="address" name="Address" rows="5" placeholder="ที่อยู่ปัจจุบัน" class="full-width"></textarea>
        <select name="BloodType" required>
            <option value="">กรุณาเลือกกรุ๊ปเลือด</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="AB">AB</option>
            <option value="O">O</option>
        </select>
        <input type="number" name="Weight" placeholder="น้ำหนัก (kg)" required>
        <input type="number" name="KidHeight" placeholder="ส่วนสูง (cm)" required>

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
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/th.js"></script>
</body>
</html>  