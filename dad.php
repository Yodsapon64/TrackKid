<?php
session_start(); 

include 'connect.php'; // เชื่อมต่อกับฐานข้อมูล

$user_id = $_SESSION['user_id'];

// ตรวจสอบว่าผู้ใช้มีข้อมูลในตาราง parent หรือไม่
$sql = "SELECT parent_id FROM parent WHERE user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    $parent_id = $result['parent_id']; // ดึง parent_id ที่เกี่ยวข้อง
} else {
    die("ไม่พบข้อมูลผู้ปกครองในระบบ กรุณาเพิ่มข้อมูลผู้ปกครองก่อน");
}

$profile_link = $stmt->rowCount() > 0 ? "view_profile.php" : "profile.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $DadFirstname = $_POST['DadFirstname']; 
    $DadLastname = $_POST['DadLastname']; 
    $DadAge = $_POST['DadAge']; 
    $DadTel = $_POST['DadTel']; 
    
    $MomFirstname = $_POST['MomFirstname']; 
    $MomLastname = $_POST['MomLastname']; 
    $MomAge = $_POST['MomAge']; 
    $MomTel = $_POST['MomTel']; 
    
    $sql = "INSERT INTO dad (user_id, parent_id, DadFirstname, DadLastname, DadAge, DadTel, MomFirstname, MomLastname, MomAge, MomTel)
        VALUES (:user_id, :parent_id, :DadFirstname, :DadLastname, :DadAge, :DadTel, :MomFirstname, :MomLastname, :MomAge, :MomTel)";
$stmt = $conn->prepare($sql);

$stmt->bindParam(':parent_id', $parent_id); // ผูก parent_id ที่ดึงมา
$stmt->bindParam(':user_id', $user_id);
$stmt->bindParam(':DadFirstname', $DadFirstname);
$stmt->bindParam(':DadLastname', $DadLastname);
$stmt->bindParam(':DadAge', $DadAge);
$stmt->bindParam(':DadTel', $DadTel);
$stmt->bindParam(':MomFirstname', $MomFirstname);
$stmt->bindParam(':MomLastname', $MomLastname);
$stmt->bindParam(':MomAge', $MomAge);
$stmt->bindParam(':MomTel', $MomTel);

if ($stmt->execute()) {
    echo "<script>alert('บันทึกข้อมูลสำเร็จ');</script>";
    header("Location: kid.php");
    exit();
} else {
    echo "Error inserting data.";
}

}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลผู้ปกครอง</title>
    <link rel="stylesheet" href="Css/dad.css">
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
                <h2>กรุณากรอกข้อมูลส่วนตัวของพ่อ และแม่</h2>
                <form action="" method="post">
                    <div class="section-title">ข้อมูลบิดา</div>
                    <input type="text" name="DadFirstname" placeholder="ชื่อบิดา" required>
                    <input type="text" name="DadLastname" placeholder="นามสกุลบิดา" required>
                    <input type="number" name="DadAge" placeholder="อายุบิดา" required>
                    <input type="tel" name="DadTel" placeholder="เบอร์โทรบิดา" required>

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
