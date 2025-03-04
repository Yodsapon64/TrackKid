<?php
session_start();
include 'connect.php'; // เชื่อมต่อกับฐานข้อมูล

$user_id = $_SESSION['user_id'];

// ดึง parent_id
$sql_parent = "SELECT parent_id FROM parent WHERE user_id = :user_id";
$stmt_parent = $conn->prepare($sql_parent);
$stmt_parent->bindParam(':user_id', $user_id);
$stmt_parent->execute();
$parent = $stmt_parent->fetch(PDO::FETCH_ASSOC);

if ($parent) {
    $parent_id = $parent['parent_id'];
} else {
    // กรณีที่ parent_id ไม่เจอ
    echo "<script>alert('กรุณากรอกข้อมูลผู้ปกครองก่อนเพิ่มข้อมูลเด็ก');</script>";
    header("Location: profile.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $KidFirstname = $_POST['KidFirstname'];
    $KidLastname = $_POST['KidLastname'];
    $KidBirth = $_POST['KidBirth'];
    $KidGender = $_POST['KidGender'];
    $Address = $_POST['Address'];
    $BloodType = $_POST['BloodType'];
    $Weight = $_POST['Weight'];
    $KidHeight = $_POST['KidHeight'];

    // คำนวณอายุจากวันเกิด
    $birthDateObj = new DateTime($KidBirth);
    $currentDate = new DateTime();
    $KidAge = $currentDate->diff($birthDateObj)->y;

    // กำหนดวันที่ปัจจุบันสำหรับ UpdateDate
    $UpdateDate = $currentDate->format('Y-m-d H:i:s');

    // เพิ่มข้อมูลเด็กในฐานข้อมูล
    $sql = "INSERT INTO kid (user_id, parent_id, KidFirstname, KidLastname, KidBirth, KidAge, KidGender, Address, BloodType, Weight, KidHeight, UpdateDate)
            VALUES (:user_id, :parent_id, :KidFirstname, :KidLastname, :KidBirth, :KidAge, :KidGender, :Address, :BloodType, :Weight, :KidHeight, :UpdateDate)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':KidFirstname', $KidFirstname);
    $stmt->bindParam(':KidLastname', $KidLastname);
    $stmt->bindParam(':KidBirth', $KidBirth);
    $stmt->bindParam(':KidAge', $KidAge);
    $stmt->bindParam(':KidGender', $KidGender);
    $stmt->bindParam(':Address', $Address);
    $stmt->bindParam(':BloodType', $BloodType);
    $stmt->bindParam(':Weight', $Weight);
    $stmt->bindParam(':KidHeight', $KidHeight);
    $stmt->bindParam(':UpdateDate', $UpdateDate);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':parent_id', $parent_id);

    if ($stmt->execute()) {
        echo "<script>alert('บันทึกข้อมูลสำเร็จ');</script>";
        header("Location: nutritional.php");
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
    <title>เพิ่มข้อมูลเด็ก</title>
    <link rel="stylesheet" href="Css/kid.css">
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
                <h2>กรุณากรอกข้อมูลส่วนตัว</h2>
                <form action="" method="post">
                    <div class="section-title">ข้อมูลเด็ก</div>
                    <input type="text" name="KidFirstname" placeholder="ชื่อเด็ก" required>
                    <input type="text" name="KidLastname" placeholder="นามสกุลเด็ก" required>
                    <input type="date" name="KidBirth" id="kidBirth" placeholder="วันเกิดเด็ก" required class="full-width">
                    
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
                    <button type="submit" class="signup-btn">บันทึกข้อมูล</button>
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


    <script>
        document.getElementById('kidBirth').addEventListener('change', function () {
            const birthDate = new Date(this.value);
            const today = new Date();
            const age = today.getFullYear() - birthDate.getFullYear();
            if (today < new Date(birthDate.setFullYear(today.getFullYear()))) {
                age--;
            }
        });
    </script>
</body>
</html>
