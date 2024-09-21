<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="Css/main.css">
    <script src="main.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="topbar">
            <div class="logo">
                <a href="index.php">เว็บแอปพลิเคชันสำหรับติดตามการเจริญเติบโตของเด็กอายุ 0-12 ปี</a>
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

        <div class="container">
        <div class="banner">
            <div class="banner-content">
                <div class="banner-text">
                    <h1>Alice Hope MD</h1>
                    <h3>Online Medical Services</h3>
                    <p>Reliable, Easy & Accessible to All</p>
                </div>
                <div class="banner-image">
                    <img src="img/img7.jpg" alt="Mother and Child" class="image">
                </div>
            </div>
        </div>
    </div>

        <div class="content-section">
            <div class="content-box">
                <img src="img/img2.jpg" alt="Nutrition Image" class="content-image">
                <div class="content-text">
                    <h2>โภชนาการในเด็ก</h2>
                    <p>โภชนาการเป็นส่วนสำคัญในช่วงวัยเด็ก ซึ่งเป็นพื้นฐานสำคัญสำหรับการเติบโต และ 
                        <br> พัฒนาการที่สมบูรณ์ของเด็ก หากภาวะโภชนาการที่สูงเกิน หรือ ต่ำเกินไป จะส่งผลให้มีปัญหาในการเติบโต เจ็บปวด และ เสียชีวิตได้</p>
                    <button class="learn-more-button"><a href="nutrition2.php">ข้อมูลเพิ่มเติม</a></button>
                </div>
            </div>
            <div class="content-box">
                <img src="img/img3.jpg" alt="Vaccine Image" class="content-image">
                <div class="content-text">
                    <h2>วัคซีนและการฉีดวัคซีน</h2>
                    <p>การฉีดวัคซีนเป็นวิธีที่สำคัญในการปกป้องเด็กจากโรคติดเชื้อที่อาจเป็นอันตราย เช่น โรคหัด คางทูม และโปลิโอ การฉีดวัคซีนจะช่วยเสริมสร้างภูมิคุ้มกันในร่างกายของเด็ก ทำให้พวกเขามีความเสี่ยงต่ำต่อการติดโรคและป้องกันการแพร่ระบาดของโรคในชุมชน</p>
                    <button class="learn-more-button"><a href="vaccination2.php">ข้อมูลเพิ่มเติม</a></button>
                </div>
            </div>
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>