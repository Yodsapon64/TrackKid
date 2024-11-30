<?php
session_start(); 

include 'connect.php'; // เชื่อมต่อกับฐานข้อมูล

$user_id = $_SESSION['user_id'];

// ตรวจสอบว่าผู้ใช้มีข้อมูลในตาราง parent หรือไม่
$sql = "SELECT * FROM parent WHERE user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();

$profile_link = $stmt->rowCount() > 0 ? "view_profile.php" : "profile.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") { // ตรวจสอบว่ามีการส่งข้อมูลด้วยวิธี POST
    $DadFirstname = $_POST['DadFirstname']; // ชื่อบิดา
    $DadLastname = $_POST['DadLastname']; // นามสกุลบิดา
    $DadAge = $_POST['DadAge']; // อายุบิดา
    $DadTel = $_POST['DadTel']; // เบอร์โทรบิดา
    
    $MomFirstname = $_POST['MomFirstname']; // ชื่อมารดา
    $MomLastname = $_POST['MomLastname']; // นามสกุลมารดา
    $MomAge = $_POST['MomAge']; // อายุมารดา
    $MomTel = $_POST['MomTel']; // เบอร์โทรมารดา
    
    
    $sql = "INSERT INTO dad (user_id, DadFirstname, DadLastname, DadAge, DadTel, MomFirstname, MomLastname, MomAge, MomTel)
            VALUES (:user_id, :DadFirstname, :DadLastname, :DadAge, :DadTel, :MomFirstname, :MomLastname, :MomAge, :MomTel)";

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
    $stmt->bindParam(':user_id', $_SESSION['user_id']); 

    if ($stmt->execute()) { // ถ้าสำเร็จ
        $last_id = $conn->lastInsertId(); // รับ ID ล่าสุดที่เพิ่มเข้าไป
        $_SESSION['last_id'] = $last_id;
        echo "<script>alert('บันทึกข้อมูลสำเร็จ');</script>";
        header("Location: kid.php"); // เปลี่ยนเส้นทางไปยังหน้า nutritional.php พร้อมกับ ID
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
    <link rel="stylesheet" href="Css/dad.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
                <li><a href="dad.php">เพิ่มข้อมูลผู้ใช้งาน</a></li>
                <li><a href="<?php echo $profile_link; ?>">ยินดีต้อนรับ <?php echo htmlspecialchars($_SESSION['username']); ?></a></li>
        </ul>
    </div>


    <div class="signup-container">
        <div class="signup-card">
            <div class="signup-left">
                <img src="img/img4.jpg" alt="Sign Up Image">
            </div>
            <div class="signup-right">
                <h2>กรุณากรอกข้อมูลส่วนตัวของพ่อ และ แม่</h2>
                
                <form action="" method="post">
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
                    <button type="submit" class="signup-btn">ดำเนินการต่อไป</button>
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

    
</body>
</html>  