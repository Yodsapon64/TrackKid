<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $DadFirstname = $_POST['DadFirstname'];
    $DadLastname = $_POST['DadLastname'];
    $DadAge = $_POST['DadAge'];
    $DadTel = $_POST['DadTel'];
    
    $MomFirstname = $_POST['MomFirstname'];
    $MomLastname = $_POST['MomLastname'];
    $MomAge = $_POST['MomAge'];
    $MomTel = $_POST['MomTel'];
    
    $ParentFirstname = $_POST['ParentFirstname'];
    $ParentLastname = $_POST['ParentLastname'];
    $ParentStatus = $_POST['ParentStatus'];
    $ParentAge = $_POST['ParentAge'];
    $ParentEmail = $_POST['ParentEmail'];
    $ParentTel = $_POST['ParentTel'];
    
    $KidFirstname = $_POST['KidFirstname'];
    $KidLastname = $_POST['KidLastname'];
    $KidBirth = $_POST['KidBirth'];
    $KidGender = $_POST['KidGender'];
    $Address = $_POST['Address'];
    $BloodType = $_POST['BloodType'];
    $Weight = $_POST['weight'];
    $KidHeight = $_POST['KidHeight'];

    // Convert date to correct format
    $kidBirthDate = DateTime::createFromFormat('Y-m-d', $KidBirth);
    if ($kidBirthDate) {
        $KidBirth = $kidBirthDate->format('Y-m-d'); // Store in correct format
    } else {
        $KidBirth = '1970-01-01'; // Default value if error
    }

    // Prepare SQL statement
    $sql = "INSERT INTO info (DadFirstname, DadLastname, DadAge, DadTel, MomFirstname, MomLastname, MomAge, MomTel, ParentFirstname, ParentLastname, ParentStatus, ParentAge, ParentEmail, ParentTel, KidFirstname, KidLastname, KidBirth, KidGender, Address, BloodType, Weight, KidHeight) 
            VALUES (:DadFirstname, :DadLastname, :DadAge, :DadTel, :MomFirstname, :MomLastname, :MomAge, :MomTel, :ParentFirstname, :ParentLastname, :ParentStatus, :ParentAge, :ParentEmail, :ParentTel, :KidFirstname, :KidLastname, :KidBirth, :KidGender, :Address, :BloodType, :Weight, :KidHeight)";
    
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':DadFirstname', $DadFirstname);
    $stmt->bindParam(':DadLastname', $DadLastname);
    $stmt->bindParam(':DadAge', $DadAge);
    $stmt->bindParam(':DadTel', $DadTel);
    
    $stmt->bindParam(':MomFirstname', $MomFirstname);
    $stmt->bindParam(':MomLastname', $MomLastname);
    $stmt->bindParam(':MomAge', $MomAge);
    $stmt->bindParam(':MomTel', $MomTel);
    
    $stmt->bindParam(':ParentFirstname', $ParentFirstname);
    $stmt->bindParam(':ParentLastname', $ParentLastname);
    $stmt->bindParam(':ParentStatus', $ParentStatus);
    $stmt->bindParam(':ParentAge', $ParentAge);
    $stmt->bindParam(':ParentEmail', $ParentEmail);
    $stmt->bindParam(':ParentTel', $ParentTel);
    
    $stmt->bindParam(':KidFirstname', $KidFirstname);
    $stmt->bindParam(':KidLastname', $KidLastname);
    $stmt->bindParam(':KidBirth', $KidBirth);
    $stmt->bindParam(':KidGender', $KidGender);
    $stmt->bindParam(':Address', $Address);
    $stmt->bindParam(':BloodType', $BloodType);
    $stmt->bindParam(':Weight', $Weight);
    $stmt->bindParam(':KidHeight', $KidHeight);

    // Execute the statement
    if ($stmt->execute()) {
        $lastId = $conn->lastInsertId();
        // Redirect to nutritional.php with child ID
        echo "<script>window.location.href = 'nutritional.php?id=" . $lastId . "';</script>";
    } else {
        // Display error
        echo "<script>alert('เกิดข้อผิดพลาด: " . $stmt->errorInfo()[2] . "');</script>";
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
    <h2>เพิ่มข้อมูลส่วนตัวเด็ก</h2>
    <p>โปรดกรอกข้อมูลด้านล่าง</p>
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

        <!-- Guardian Section -->
        <div class="section-title">ข้อมูลผู้ปกครอง</div>
        <input type="text" name="ParentFirstname" placeholder="ชื่อผู้ปกครอง" required>
        <input type="text" name="ParentLastname" placeholder="นามสกุลผู้ปกครอง" required>
        <input type="text" name="ParentStatus" placeholder="สถานภาพผู้ปกครอง" required>
        <input type="number" name="ParentAge" placeholder="อายุผู้ปกครอง" required>
        <input type="email" name="ParentEmail" placeholder="อีเมลผู้ปกครอง" required>
        <input type="tel" name="ParentTel" placeholder="เบอร์โทรผู้ปกครอง" required>

        <!-- Child Section -->
        <div class="section-title">ข้อมูลเด็ก</div>
        <input type="text" name="KidFirstname" placeholder="ชื่อเด็ก" required>
        <input type="text" name="KidLastname" placeholder="นามสกุลเด็ก" required>
        <input type="text" name="KidBirth" id="kidBirth" placeholder="วันเกิดเด็ก" required class="full-width">
        
        <label for="KidGender" class="full-width">เพศของเด็ก</label>
        <div class="gender-toggle">
            <input type="radio" id="kidMale" name="KidGender" value="ชาย">
            <label for="kidMale" class="gender-label male">ชาย</label>
            <input type="radio" id="kidFemale" name="KidGender" value="หญิง">
            <label for="kidFemale" class="gender-label female">หญิง</label>
        </div>

        <textarea id="address" name="Address" rows="4" placeholder="ที่อยู่ปัจจุบัน" class="full-width"></textarea>
        <select name="BloodType" required class="full-width">
            <option value="">กรุ๊ปเลือดของเด็ก</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="AB">AB</option>
            <option value="O">O</option>
        </select>
        
        <input type="number" name="weight" placeholder="น้ำหนักเด็ก (kg)" required>
        <input type="number" name="KidHeight" placeholder="ส่วนสูงเด็ก (cm)" required>

        <button type="submit">บันทึกข้อมูล</button>
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
<script>
    flatpickr("#kidBirth", {
        dateFormat: "Y-m-d",
        maxDate: new Date().fp_incr(-1) // Set max date to yesterday
    });

    function validateForm() {
        // Implement form validation if needed
        return true;
    }
</script>
</body>
</html>
