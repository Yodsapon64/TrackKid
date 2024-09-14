<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลเด็ก</title>
    <link rel="stylesheet" href="Css/info.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .form-container {
            width: 60%;
            margin: 0 auto;
            padding: 20px;
        }
        .section-title {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .info-form {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
        .info-form input, .info-form select, .info-form textarea {
            width: 100%;
            padding: 10px;
            font-size: 14px;
        }
        .info-form .full-width {
            grid-column: span 2;
        }
        .gender-toggle {
            display: flex;
            align-items: center;
        }
        .gender-label {
            margin-right: 20px;
        }
        .submit-btn {
            grid-column: span 2;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
    </style>
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
                <li><a href="info.php">เพิ่มข้อมูลผู้ใช้งาน</a></li>
                <li><a href="logout.php" class="list-group-item list-group-item-danger" onclick="return confirm('ยืนยันการออกจากระบบ');">ออกจากระบบ</a></li>
        </ul>
    </div>

    <div class="form-container">
        <h2>เพิ่มข้อมูลส่วนตัวเด็ก</h2>
        <p>โปรดกรอกข้อมูลด้านล่าง</p>
        <form action="" method="post" class="info-form">
            <!-- Father Section -->
            <div class="section-title full-width">ข้อมูลบิดา</div>
            <input type="text" name="DadFirstname" placeholder="ชื่อบิดา" required>
            <input type="text" name="DadLastname" placeholder="นามสกุลบิดา" required>
            <input type="number" name="DadAge" placeholder="อายุบิดา" required>
            <input type="tel" name="DadTel" placeholder="เบอร์โทรบิดา" required>

            <!-- Mother Section -->
            <div class="section-title full-width">ข้อมูลมารดา</div>
            <input type="text" name="MomFirstname" placeholder="ชื่อมารดา" required>
            <input type="text" name="MomLastname" placeholder="นามสกุลมารดา" required>
            <input type="number" name="MomAge" placeholder="อายุมารดา" required>
            <input type="tel" name="MomTel" placeholder="เบอร์โทรมารดา" required>

            <!-- Guardian Section -->
            <div class="section-title full-width">ข้อมูลผู้ปกครอง</div>
            <input type="text" name="ParentFirstname" placeholder="ชื่อผู้ปกครอง" required>
            <input type="text" name="ParentLastname" placeholder="นามสกุลผู้ปกครอง" required>
            <input type="text" name="ParentStatus" placeholder="สถานภาพผู้ปกครอง" required>
            <input type="number" name="ParentAge" placeholder="อายุผู้ปกครอง" required>
            <input type="email" name="ParentEmail" placeholder="อีเมลผู้ปกครอง" required>
            <input type="tel" name="ParentTel" placeholder="เบอร์โทรผู้ปกครอง" required>

            <!-- Child Section -->
            <div class="section-title full-width">ข้อมูลเด็ก</div>
            <input type="text" name="KidFirstname" placeholder="ชื่อเด็ก" required>
            <input type="text" name="KidLastname" placeholder="นามสกุลเด็ก" required>
            <input type="text" name="KidBirth" id="kidBirth" placeholder="วันเกิดเด็ก" required class="full-width">
            
            <label for="KidGender" class="full-width">เพศของเด็ก</label>
            <div class="gender-toggle full-width">
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
            <input type="number" name="weight" step="0.1" placeholder="น้ำหนัก (กิโลกรัม)" required>
            <input type="number" name="KidHeight" step="0.1" placeholder="ส่วนสูง (เซนติเมตร)" required>
            
            <button type="submit" class="submit-btn">ยืนยันข้อมูล</button>
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

    <!-- Scripts for Flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/th.js"></script>
    <script>
        flatpickr("#kidBirth", {
            dateFormat: "d-m-Y",
            maxDate: "today",
            locale: "th",
            onReady: function(selectedDates, dateStr, instance) {
                const currentYear = instance.currentYear + 543; // Convert to Buddhist Era
                instance.currentYearElement.value = currentYear;
            },
            onChange: function(selectedDates, dateStr, instance) {
                const currentYear = selectedDates[0].getFullYear() + 543; // Update year to BE
                instance.currentYearElement.value = currentYear;
            }
        });
    </script>
</body>
</html>
