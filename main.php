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
        

        <div class="banner">
    <h2>Title of a longer featured blog post</h2>
    <p>Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>
</div>


<div class="three-columns">
    <div class="column">
        <div class="circle-image">
            <img src="img/icon2.jpg" alt="Icon 1">
        </div>
        <h3>Heading</h3>
        <p>Some representative placeholder content for the first column.</p>
    </div>
    <div class="column">
        <div class="circle-image">
            <img src="img/icon5.jpg" alt="Icon 2">
        </div>
        <h3>Heading</h3>
        <p>Another exciting bit of representative placeholder content.</p>
    </div>
    <div class="column">
        <div class="circle-image">
            <img src="img/icon4.jpg" alt="Icon 3">
        </div>
        <h3>Heading</h3>
        <p>And lastly this, the third column of representative placeholder content.</p>
    </div>
</div>



<div class="featurette">
    <div class="featurette-item">
        <div class="featurette-text">
            <h2>First featurette heading. It’ll blow your mind.</h2>
            <p>Some great placeholder content for the first featurette here. Imagine some exciting prose here.</p>
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
            <h2>Oh yeah, it’s that good. See for yourself.</h2>
            <p>Another featurette? Of course. More placeholder content here to give you an idea of how this layout would work with some actual real-world content in place.</p>
        </div>
    </div>

    <hr class="featurette-divider">

    <div class="featurette-item">
        <div class="featurette-text">
            <h2>And lastly, this one. Checkmate.</h2>
            <p>And yes, this is the last block of representative placeholder content. Again, not really intended to be actually read, simply here to give you a better view of what this would look like with some actual content. Your content.</p>
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