<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="Css/index.css">
</head>
<body>
    <div class="topbar">
        <div class="logo">
            <a href="index.php">เว็บแอปพลิเคชันสำหรับติดตามการเจริญเติบโตของเด็กอายุ 0-12 ปี</a>
        </div>
        <ul class="menu">
            <li><a href="index.php">หน้าหลัก</a></li>
            <li><a href="about.php">เกี่ยวกับเรา</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="container">
        <div class="banner">
            <img src="img/img1.jpg" alt="Child Image" class="banner-image">
            <div class="overlay">
                <div class="textbanner">
                    <h1>ยินดีต้อนรับสู่เว็บไซต์สุขภาพของเด็กอายุ 0-12 ปี</h1>
                    <p>พร้อมรึยัง! เตรียมตัวมุ่งสู่สุขภาพเด็กที่แข็งแรงขึ้น</p>
                    <button class="join-us-button"><a href="login.php">เข้าร่วมกับเรา</a></button>
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
                <button class="learn-more-button"><a href="nutrition.php">ข้อมูลเพิ่มเติม</a></button>
            </div>
        </div>
        <div class="content-box">
            <img src="img/img3.jpg" alt="Vaccine Image" class="content-image">
            <div class="content-text">
                <h2>วัคซีนและการฉีดวัคซีน</h2>
                <p>การฉีดวัคซีนเป็นวิธีที่สำคัญในการปกป้องเด็กจากโรคติดเชื้อที่อาจเป็นอันตราย เช่น โรคหัด คางทูม และโปลิโอ การฉีดวัคซีนจะช่วยเสริมสร้างภูมิคุ้มกันในร่างกายของเด็ก ทำให้พวกเขามีความเสี่ยงต่ำต่อการติดโรคและป้องกันการแพร่ระบาดของโรคในชุมชน</p>
                <button class="learn-more-button"><a href="vaccination.php">ข้อมูลเพิ่มเติม</a></button>
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
</body>
</html>
