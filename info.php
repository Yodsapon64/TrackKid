<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="Css/info.css">
</head>
<body>
    <div class="topbar">
        <div class="logo">
            <a href="main.php">เว็บแอปพลิเคชันสำหรับติดตามการเจริญเติบโตของเด็กอายุ 0-12 ปี</a>
        </div>
        <ul class="menu">
            <li><a href="main.php">หน้าหลัก</a></li>
            <li><a href="about2.php">เกี่ยวกับเรา</a></li>
            <li><a href="#">ข้อมูลภาวะโภชนาการ</a></li>
            <li><a href="#">ข้อมูลวัคซีน</a></li>
            <li><a href="logout.php" class="list-group-item list-group-item-danger" onclick="return confirm('ยืนยันการออกจากระบบ');">ออกจากระบบ</a></li>
        </ul>
    </div>

    <!-- Form starts here -->
    <div class="form-container">
        <h2>ข้อมูลผู้ใช้งาน</h2>
        <form action="" method="post">
                    <input type="text" name="" placeholder="ชื่อผู้ปกครองของเด็ก" required>
                    <input type="text" name="" placeholder="นามสกุลผู้ปกครองของเด็ก" required>
                    <input type="date" name="" placeholder="วันเกิดผู้ปกครองของเด็ก" required>
                    <input type="tel" name="" placeholder="เบอร์โทรผู้ปกครองของเด็ก" required>
                    <input type="text" name="" placeholder="ที่อยู่ผู้ปกครองของเด็ก" required>

                    <select id="" name="" required>
                <option value="" disabled selected>ท่านเป็นอะไรกับเด็ก</option>
                <option value="">บิดา</option>
                <option value="">มารดา</option>
                <option value="">ปู่</option>
                <option value="">ย่า</option>
                <option value="">ตา</option>
                <option value="">ยาย</option>
                <option value="">ลุง</option>
                <option value="">ป้า</option>
                <option value="">น้า</option>
                <option value="">อา</option>
                <option value="">อื่นๆ</option>
            </select>
                    <input type="text" name="" placeholder="ชื่อเด็ก" required>
                    <input type="text" name="" placeholder="นามสกุลเด็ก" required>
                    <input type="date" name="" placeholder="วันเกิดของเด็ก" required>
                    <input type="" name="" placeholder="น้ำหนักของเด็ก(กิโลกรัม)" required>
                    <input type="" name="" placeholder="ส่วนสูงของเด็ก(เซนติเมตร)" required>
                    <input type="" name="" placeholder="เพศของเด็ก" required>
                    <input type="" name="" placeholder="โรคประจำตัว" required>
                    <input type="" name="" placeholder="อาหารที่แพ้" required>
                    <input type="" name="" placeholder="" required>
                    <button type="submit" class="login-btn">ยืนยันข้อมูลส่วนตัว</button>
                    <button type="button" class="signup-btn" onclick="window.location.href='sign.php'">สมัครสมาชิก</button>
                    <p><a href="#">ท่านลืมรหัสผ่านหรือไม่?</a></p>
                </form>

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
