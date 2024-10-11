<?php
session_start();
include 'connect.php';
$sql = "SELECT * FROM info"; // คุณอาจต้องแก้ไขให้ดึงข้อมูลที่ต้องการ
$stmt = $conn->prepare($sql);
$stmt->execute();
$children = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="Css/main.css">
    <script src="main.js"></script>
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
                <li><a href="profile.php">ยินดีต้อนรับ <?php echo $_SESSION['username']; ?></a></li>
            </ul>
        </div>
        

        <div class="banner">
    <h2>ยินดีต้อนรับสำหรับการสมัครสมาชิกของท่าน</h2>
    <p>กรุณากรอกเพิ่มข้อมูลส่วนตัวสำหรับสิทธิประโยชน์ต่างๆ เช่น การประเมินภาวะโภวชนาการ การได้รับความรู้และคำแนะนำในการดูแลเด็ก
         และ การได้รับข้อมูลการฉีดวัคซีน
    </p>
</div>


<div class="three-columns">
    <div class="column">
        <div class="circle-image">
            <img src="img/icon2.jpg" alt="Icon 1">
        </div>
        <h3>ประเมินภาวะโภชนาการ</h3>
        <p>แสดงผลภาวะโภชนาการจากการคำนวณน้ำหนัก และ ส่วนสูงในเด็ก พร้อมให้คำแนะนำในการเลี้ยงดูเด็ก</p>
    </div>
    <div class="column">
        <div class="circle-image">
            <img src="img/icon5.jpg" alt="Icon 2">
        </div>
        <h3>คำแนะนำในการเลี้ยงดูเด็ก</h3>
        <p>ให้คำแนะนำในการเลี้ยงดูเด็กในแต่ละภาวะโภชนาการ เนื้อหาที่ได้มาจากสมุดบันทึกสุขภาพแม่ และ เด็ก 
            แต่เว็บของเรานั้นสามารถเข้าถึงข้อมูลได้ง่าย และ ตรงประเด็นกว่าสมุดบันทึกสุขภาพแม่ และ เด็ก 
        </p>
    </div>
    <div class="column">
        <div class="circle-image">
            <img src="img/icon4.jpg" alt="Icon 3">
        </div>
        <h3>ข้อมูลวัคซีน</h3>
        <p>แสดงข้อมูลประวัติวัคซีนที่ได้การฉีด แสดงรายละเอียดของข้อมูลในแต่ละชนิด 
            สามารถดูวันนัดการฉีดวัคซีน สถานที่การเข้ารํบการฉีดวัคซีน
        และ สามารถแจ้งเตือนการฉีดวัคซีนได้</p>
    </div>
</div>



<div class="featurette">
<h2>เว็บแอปพลิเคชันของเราส่งผลต่อผลประโยชน์อะไรต่อเด็กบ้าง</h2>
    <div class="featurette-item">
        <div class="featurette-text">
            <h2>เด็กๆสามารถทำกิจกรรมต่างๆร่วมกับผู้อื่นในสังคมได้อย่างแข็งแรงสมบูรณ์ มีภูมิคุ้มกันไม่เจ็บป่วยได้ง่าย</h2>
        </div>
        <div class="featurette-image">
            <img src="img/img7.jpg" alt="500x500 placeholder image">
        </div>
    </div>

    <hr class="featurette-divider">

    <div class="featurette-item">
        <div class="featurette-image">
            <img src="img/img8.jpg" alt="500x500 placeholder image">
        </div>
        <div class="featurette-text">
            <h2>สร้างความสุข และ ความสัมพันธ์ในครอบครัวที่ดีในการดูแลเด็กให้ร่างการแข็งแรงสมบูรณ์</h2>
            <p></p>
        </div>
    </div>

    <hr class="featurette-divider">

    <div class="featurette-item">
        <div class="featurette-text">
            <h2>ด้วยภาวะโภชนาการที่แข็งแรงสมบูรณ์ทำให้เด็กสามารถเติบโตได้อย่างแข็งแรงสมบูรณ์ และ มีพัฒนาการที่ดี</h2>
        </div>
        <div class="featurette-image">
            <img src="img/img9.jpg" alt="500x500 placeholder image">
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