<?php
session_start();

// ตรวจสอบว่ามีการส่งข้อมูลมาจาก nutritional.php หรือไม่
if (isset($_GET['status']) && isset($_GET['name']) && isset($_GET['birth']) && isset($_GET['age']) && isset($_GET['gender']) && isset($_GET['weight']) && isset($_GET['height'])) {
    $nutritionStatus = $_GET['status'];
    $name = $_GET['name'];
    $birth = $_GET['birth'];
    $age = $_GET['age'];
    $gender = $_GET['gender'];
    $weight = $_GET['weight'];
    $height = $_GET['height'];
} else {
    echo "ข้อมูลไม่ครบถ้วน";
    exit();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>คำแนะนำภาวะโภชนาการ</title>
    <link rel="stylesheet" href="Css/advice.css">
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
        
    <div class="content">
        <h1>คำแนะนำภาวะโภชนาการ</h1>
        <p>ชื่อ: <?php echo htmlspecialchars($name); ?></p>
        <p>วันเกิด: <?php echo htmlspecialchars($birth); ?></p>
        <p>อายุ: <?php echo htmlspecialchars($age); ?> ปี</p>
        <p>เพศ: <?php echo htmlspecialchars($gender); ?></p>
        <p>น้ำหนัก: <?php echo htmlspecialchars($weight); ?> กิโลกรัม</p>
        <p>ส่วนสูง: <?php echo htmlspecialchars($height); ?> เซนติเมตร</p>
        <p>ภาวะโภชนาการ: <strong><?php echo htmlspecialchars($nutritionStatus); ?></strong></p>

        <!-- แสดงคำแนะนำตามภาวะโภชนาการ -->
        <h2>คำแนะนำ</h2>
        <?php
        switch ($nutritionStatus) {
            case 'อ้วน':
                echo "<p>คำแนะนำสำหรับเด็กที่อ้วน: ควรมีการควบคุมอาหารและเพิ่มการออกกำลังกาย...</p>";
                break;
            case 'เริ่มอ้วน':
                echo "<p>คำแนะนำสำหรับเด็กที่เริ่มอ้วน: ควรเริ่มปรับอาหารและเพิ่มการเคลื่อนไหว...</p>";
                break;
            case 'ท้วม':
                echo "<p>คำแนะนำสำหรับเด็กที่ท้วม: ควรรักษาน้ำหนักตัวให้สมดุล...</p>";
                break;
            case 'สมส่วน':
                echo "<p>คำแนะนำสำหรับเด็กที่สมส่วน: ควรรักษาน้ำหนักและสุขภาพให้ดี...</p>";
                break;
            case 'ค่อนข้างผอม':
                echo "<p>คำแนะนำสำหรับเด็กที่ค่อนข้างผอม: ควรเพิ่มการบริโภคอาหาร...</p>";
                break;
            case 'ผอม':
                echo "<p>คำแนะนำสำหรับเด็กที่ผอม: ควรมีการบริโภคอาหารที่มีแคลอรีสูง...</p>";
                break;
            case 'ผอมมาก':
                echo "<p>คำแนะนำสำหรับเด็กที่ผอมมาก: ควรปรึกษาแพทย์เพื่อแผนการดูแลสุขภาพ...</p>";
                break;
            default:
                echo "<p>ไม่พบคำแนะนำ</p>";
        }
        ?>
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
