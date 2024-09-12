<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลเด็ก</title>
    <link rel="stylesheet" href="Css/info.css">
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
            <li><a href="#">ข้อมูลภาวะโภชนาการ</a></li>
            <li><a href="#">ข้อมูลวัคซีน</a></li>
        </ul>
    </div>

    <div class="form-container">
        <h2>ยินดีต้อนรับสู่หน้าการเพิ่มข้อมูลส่วนตัวของเด็ก</h2>
        <p>โปรดกรอกข้อมูลเพื่อเริ่มต้นการประเมินภาวะโภชนาการ</p>
        <form action="" method="post" class="info-form">
            <input type="text" name="DadFirstname" placeholder="ชื่อบิดา" required>
            <input type="text" name="DadLastname" placeholder="นามสกุลบิดา" required>
            
            <!-- Date Picker Input for Dad's Birthdate -->
            <input type="text" name="DadBirth" id="dadBirth" placeholder="วันเกิดบิดา">

            <input type="text" name="MomFirstname" placeholder="ชื่อมารดา" required>
            <input type="text" name="MomLastname" placeholder="นามสกุลมารดา" required>

            <!-- Date Picker Input for Mom's Birthdate -->
            <input type="text" name="MomBirth" id="momBirth" placeholder="วันเกิดมารดา">

            <input type="text" name="ParentFirstname" placeholder="ชื่อผู้ปกครอง" required>
            <input type="text" name="ParentLastname" placeholder="นามสกุลผู้ปกครอง" required>

            <!-- Date Picker Input for Parent's Birthdate -->
            <input type="text" name="ParentBirth" id="parentBirth" placeholder="วันเกิดผู้ปกครอง">

            <label for="ParentGender">เพศของผู้ปกครอง</label>
            <!-- Custom Gender Selection Toggle -->
            <div class="gender-toggle">
                <input type="radio" id="male" name="ParentGender" value="ชาย">
                <label for="male" class="gender-label male">ชาย</label>
                <input type="radio" id="female" name="ParentGender" value="หญิง">
                <label for="female" class="gender-label female">หญิง</label>
            </div>

            <input type="text" name="ParentRelationship" placeholder="บทบาทความสำคัญเกี่ยวกับเด็ก" required>
            <textarea id="address" name="Address" rows="4" placeholder="ที่อยู่ปัจจุบัน"></textarea>
            <input type="tel" name="Tel" placeholder="เบอร์โทรติดต่อผู้ปกครอง">
            <input type="text" name="KidFirstname" placeholder="ชื่อเด็ก" required>
            <input type="text" name="KidLastname" placeholder="นามสกุลเด็ก" required>

            <!-- Date Picker Input for Kid's Birthdate -->
            <input type="text" name="KidBirth" id="kidBirth" placeholder="วันเกิดเด็ก" required>

            <label for="KidGender">เพศของเด็ก</label>
            <!-- Custom Gender Selection Toggle for Kid -->
            <div class="gender-toggle">
                <input type="radio" id="kidMale" name="KidGender" value="ชาย">
                <label for="kidMale" class="gender-label male">ชาย</label>
                <input type="radio" id="kidFemale" name="KidGender" value="หญิง">
                <label for="kidFemale" class="gender-label female">หญิง</label>
            </div>

            <input type="number" name="weight" step="0.1" placeholder="น้ำหนักเป็นกิโลกรัม">
            <input type="number" name="KidHeight" step="0.1" placeholder="ส่วนสูงของเด็ก(เซนติเมตร)">
            <input type="text" name="BloodType" placeholder="กรุ๊ปเลือดของเด็ก">

            <button type="submit" class="submit-btn">ยืนยันการเพิ่มข้อมูลส่วนตัวเด็ก</button>
        </form>
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

    <!-- Scripts for Flatpickr and Custom Toggle -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#dadBirth", {
            dateFormat: "d-m-Y",
            maxDate: "today",
            locale: "th"
        });

        flatpickr("#momBirth", {
            dateFormat: "d-m-Y",
            maxDate: "today",
            locale: "th"
        });

        flatpickr("#parentBirth", {
            dateFormat: "d-m-Y",
            maxDate: "today",
            locale: "th"
        });

        flatpickr("#kidBirth", {
            dateFormat: "d-m-Y",
            maxDate: "today",
            locale: "th"
        });
    </script>
</body>
</html>
