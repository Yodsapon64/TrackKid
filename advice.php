<?php
session_start();

if (isset($_GET['status'], $_GET['name'], $_GET['birth'], $_GET['age'], $_GET['gender'], $_GET['weight'], $_GET['height'])) {
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        <div class="content-info">
            <h1>คำแนะนำภาวะโภชนาการ</h1>
            <h3><p><strong>ชื่อ:</strong> <?php echo htmlspecialchars($name); ?></p>
            <p><strong>วันเกิด:</strong> <?php echo htmlspecialchars($birth); ?></p>
            <p><strong>อายุ:</strong> <?php echo htmlspecialchars($age); ?> ปี</p>
            <p><strong>เพศ:</strong> <?php echo htmlspecialchars($gender); ?></p>
            <p><strong>น้ำหนัก:</strong> <?php echo htmlspecialchars($weight); ?> กิโลกรัม</p>
            <p><strong>ส่วนสูง:</strong> <?php echo htmlspecialchars($height); ?> เซนติเมตร</p>
            <p><strong>ภาวะโภชนาการ:</strong> <span class="status"><?php echo htmlspecialchars($nutritionStatus); ?></span></p></h3>

            <h2>กราฟสัดส่วนอาหาร 5 หมู่ สำหรับภาวะโภชนาการ: <?php echo htmlspecialchars($nutritionStatus); ?></h2>
            <canvas id="foodGroupChart" width="10" height="10"></canvas>
    
    <script>
        const ctx = document.getElementById('foodGroupChart').getContext('2d');
        
        let data;
        if ('<?php echo $nutritionStatus; ?>' === 'อ้วน') {
            data = [15, 25, 35, 15, 10];
        } else if ('<?php echo $nutritionStatus; ?>' === 'เริ่มอ้วน') {
            data = [20, 30, 30, 10, 10];
        } else if ('<?php echo $nutritionStatus; ?>' === 'ท้วม') {
            data = [25, 35, 25, 10, 5];
        } else if ('<?php echo $nutritionStatus; ?>' === 'สมส่วน') {
            data = [30, 30, 20, 10, 10];
        } else if ('<?php echo $nutritionStatus; ?>' === 'ค่อนข้างผอม') {
            data = [40, 20, 15, 15, 10];
        } else if ('<?php echo $nutritionStatus; ?>' === 'ผอม') {
            data = [45, 20, 15, 10, 10];
        } else if ('<?php echo $nutritionStatus; ?>' === 'ผอมมาก') {
            data = [50, 20, 15, 5, 10];
        }

        const foodGroupChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['คาร์โบไฮเดรต', 'โปรตีน', 'ผัก', 'ผลไม้', 'ไขมัน'],
                datasets: [{
                    label: 'สัดส่วนอาหาร 5 หมู่ (%)',
                    data: data,
                    backgroundColor: ['#ff6384', '#36a2eb', '#cc65fe', '#ffce56', '#4caf50'],
                    borderColor: '#fff',
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'สัดส่วนอาหาร 5 หมู่'
                    }
                }
            }
        });
    </script>


<!-- แสดงคำแนะนำตามภาวะโภชนาการ -->
<h2>คำแนะนำ</h2>
    <?php
    switch ($nutritionStatus) {
        case 'อ้วน':
            echo "<p><strong>คำแนะนำสำหรับเด็กที่อ้วน:</strong>
ควรลด การบริโภคอาหารที่มีไขมันและน้ำตาลสูง เช่น ขนมหวาน ขนมขบเคี้ยว และน้ำอัดลม ซึ่งให้พลังงานสูงแต่มีค่าน้ำตาลมาก
แนะนำให้เด็กดื่ม นมแม่ อย่างต่อเนื่อง เพราะนมแม่มีคุณค่าทางอาหารที่สมดุลกว่านมวัวหรือนมข้นหวาน
ลดปริมาณอาหารจำพวก คาร์โบไฮเดรต เช่น ข้าว ขนมปังขาว และอาหารแป้งที่ผ่านการขัดสี ควรทานข้าวกล้องแทน
เน้นการทาน โปรตีน ที่มาจากเนื้อสัตว์ไม่ติดมัน เช่น ปลา ไก่ ไข่ และควรหลีกเลี่ยงการใช้เนื้อสัตว์ที่มีไขมันสูง
เพิ่มปริมาณการทาน ผักและผลไม้ โดยเฉพาะที่มีกากใยสูง เช่น แครอท บล็อกโคลี
ควรลดการทาน ของหวาน และขนมที่มีน้ำตาลมาก เช่น ขนมเค้ก ไอศกรีม ขนมปังหวาน
ส่งเสริมการเคลื่อนไหว และการออกกำลังกายอย่างเบา ๆ เช่น การคลาน การเดินเล่น หรือเล่นกับลูกเพื่อลดพลังงานส่วนเกิน
ให้ดื่มน้ำ สะอาด แทนการดื่มน้ำหวานและน้ำอัดลม เพื่อป้องกันการสะสมของน้ำตาล
ติดตามน้ำหนัก และส่วนสูงของเด็กอย่างสม่ำเสมอ เพื่อปรับปรุงแผนการทานอาหารให้เหมาะสม
หมั่น พักผ่อนให้เพียงพอ เพราะการนอนหลับที่ดีช่วยในการเผาผลาญพลังงานและฟื้นฟูร่างกาย
สอนให้เด็กเรียนรู้ การเลือกอาหารที่ดี และลดการทานของว่างเกินจำเป็น
หากพบว่าเด็กมีน้ำหนักเกิน ควรปรึกษาแพทย์หรือผู้เชี่ยวชาญเพื่อรับคำแนะนำเพิ่มเติม​</p>";
            // เพิ่มคำแนะนำทั้งหมดตามรายละเอียดที่ให้ไปข้างต้น
            break;
        case 'เริ่มอ้วน':
            echo "<p><strong>คำแนะนำสำหรับเด็กที่เริ่มอ้วน:</strong> 
            <h3>ควรปรับเปลี่ยน พฤติกรรมการทานอาหาร โดยเริ่มลดปริมาณขนมหวาน น้ำอัดลม และอาหารทอด
ควรเพิ่มการทาน โปรตีน จากแหล่งที่ดี เช่น เนื้อปลา เนื้อไก่ไม่ติดมัน ไข่ และถั่ว ซึ่งช่วยในการสร้างกล้ามเนื้อและเผาผลาญพลังงาน
แนะนำให้เพิ่มการทาน ผักและผลไม้ ในมื้ออาหาร เช่น ผักใบเขียวและผลไม้ที่มีน้ำตาลต่ำ เช่น แอปเปิ้ล และส้ม
ควรเน้นการทาน อาหารที่มีไฟเบอร์สูง เช่น ผักและข้าวกล้อง เพื่อช่วยในการย่อยและป้องกันการสะสมของไขมัน
ลดปริมาณคาร์โบไฮเดรต และเน้นให้เด็กได้ทานข้าวกล้อง แทนขนมปังขาวหรือข้าวขัดสี
ให้ทาน ของว่างที่มีประโยชน์ เช่น ผลไม้สดหรือโยเกิร์ตแทนขนมอบกรอบหรือช็อกโกแลต
ควรจัดเวลาให้เด็ก ทำกิจกรรมที่ใช้พลังงาน เช่น การเล่นนอกบ้าน การวิ่งเล่น การเดิน หรือการเล่นกีฬาง่าย ๆ
พ่อแม่ควร ดูแลการนอนหลับ ให้เพียงพอ เพื่อให้เด็กมีพลังงานในการเผาผลาญในวันถัดไป
หลีกเลี่ยงการใช้ อาหารเป็นรางวัล เช่น ขนม หรือขนมหวาน เพราะอาจส่งผลให้เด็กเข้าใจผิดเกี่ยวกับความสัมพันธ์ระหว่างอาหารและความสุข
ติดตามน้ำหนัก และส่วนสูงของเด็กเป็นระยะๆ เพื่อดูว่ามีการเติบโตตามเกณฑ์หรือไม่
ควร ลดปริมาณน้ำตาล และไขมันในอาหารที่ทานประจำ โดยการเลือกวิธีการปรุงอาหารที่ดีต่อสุขภาพ เช่น การต้ม นึ่ง แทนการทอด
การเปลี่ยนแปลงควรเป็นไปอย่างช้าๆ และควรให้เด็ก สนุกกับการออกกำลังกาย เพื่อไม่ให้รู้สึกเครียด</h3>​</p>";
            // เพิ่มคำแนะนำทั้งหมดตามรายละเอียดที่ให้ไปข้างต้น
            break;
        case 'ท้วม':
            echo "<p><strong>คำแนะนำสำหรับเด็กที่ท้วม:</strong> 
            <h3>เด็กที่มีภาวะท้วมควรได้รับการดูแลโดยเน้น อาหารที่มีโปรตีนสูง และลดปริมาณไขมันและคาร์โบไฮเดรต
ควร ทานผักและผลไม้ ในทุกมื้อ โดยเฉพาะผลไม้ที่มีน้ำตาลต่ำ เช่น ฝรั่ง สตรอเบอร์รี่ และแตงโม
ให้เลือกทาน อาหารโปรตีนจากเนื้อสัตว์ที่ไม่ติดมัน เช่น ปลาและไก่ รวมทั้งไข่และถั่ว เพื่อเสริมสร้างกล้ามเนื้อ
แนะนำให้เด็กได้ทาน ข้าวกล้องหรือข้าวสีนิล แทนข้าวขาว หรืออาหารแป้งที่ผ่านการขัดสี
ควรลดการทานอาหารที่มี ไขมันและน้ำมัน มากเกินไป โดยเลือกวิธีการปรุงอาหารที่ดีต่อสุขภาพ เช่น การย่างหรือนึ่ง
ให้ทาน นมจืด หรือโยเกิร์ตแทนนมที่มีน้ำตาลหรือนมข้นหวาน
ดื่มน้ำเปล่า และลดการบริโภคน้ำผลไม้สำเร็จรูปหรือน้ำอัดลม
ควรจัด กิจกรรมที่ให้เด็กเคลื่อนไหว เช่น การเดิน การวิ่ง หรือการเล่นกีฬาที่ใช้พลังงาน
ให้เด็กได้ นอนหลับพักผ่อน อย่างเพียงพอ เพื่อให้ร่างกายได้ฟื้นฟูและลดการสะสมของไขมัน
ติดตามน้ำหนัก และส่วนสูงของเด็กทุกๆ 3 เดือน เพื่อปรับแผนอาหารและกิจกรรมการเคลื่อนไหวให้เหมาะสม
พ่อแม่ควร ทำอาหารร่วมกับเด็ก เพื่อให้เด็กได้เรียนรู้และสนุกกับการทานอาหารที่มีประโยชน์
ส่งเสริมให้เด็ก เล่นนอกบ้าน มากขึ้น เพื่อเผาผลาญพลังงาน</h3>​</p>";
            // เพิ่มคำแนะนำทั้งหมดตามรายละเอียดที่ให้ไปข้างต้น
            break;
        case 'สมส่วน':
            echo "<p><strong>คำแนะนำสำหรับเด็กที่สมส่วน:</strong> 
            <h3>เด็กที่อยู่ในภาวะสมส่วนควรรักษาสมดุลการรับประทานอาหารอย่างเหมาะสม โดยควรให้ความสำคัญกับการทาน โปรตีน จากเนื้อสัตว์ ปลา ไข่ และถั่ว เพื่อเสริมสร้างการเจริญเติบโต
ควรให้เด็กทาน นมแม่ต่อเนื่อง จนถึงอายุ 2 ปี หรือนานกว่านั้น และเริ่มให้อาหารเสริมตามวัยที่เหมาะสมเมื่ออายุ 6 เดือน
แนะนำให้เด็กทาน ผักและผลไม้ ในทุกมื้อ เพื่อให้ได้รับวิตามินและแร่ธาตุที่จำเป็นต่อร่างกาย
ควรให้เด็กทานอาหารที่มี คาร์โบไฮเดรต เพียงพอ โดยเน้นอาหารที่เป็นแหล่งพลังงานเช่น ข้าว ข้าวกล้อง ขนมปังโฮลวีต แทนข้าวขัดสีหรือขนมปังขาว
ลดปริมาณการทาน ขนมหวาน และอาหารที่มีน้ำตาลสูง เช่น ช็อกโกแลต ขนมเค้ก และขนมขบเคี้ยว
ส่งเสริมให้เด็กดื่ม น้ำเปล่า แทนการดื่มน้ำหวานหรือน้ำผลไม้สำเร็จรูป เพื่อป้องกันการสะสมของน้ำตาลในร่างกาย
การนอนหลับที่เพียงพอเป็นสิ่งสำคัญมากสำหรับเด็กในวัยนี้ พ่อแม่ควรดูแลให้เด็ก นอนหลับพักผ่อน ได้ดีทุกคืน
พ่อแม่ควร ทำอาหารร่วมกับเด็ก เพื่อให้เด็กได้เรียนรู้และพัฒนาทักษะการเลือกอาหารที่มีประโยชน์
ส่งเสริมให้เด็กได้ ทำกิจกรรมที่ใช้พลังงาน เช่น การคลาน การเดิน หรือการวิ่งเล่น เพื่อส่งเสริมสุขภาพร่างกาย
ควรติดตาม น้ำหนักและส่วนสูง ของเด็กเป็นประจำ เพื่อให้แน่ใจว่าเด็กมีการเจริญเติบโตตามเกณฑ์มาตรฐาน
การทานอาหารให้ครบ 5 หมู่ในทุกมื้อจะช่วยให้เด็กได้รับสารอาหารที่จำเป็นต่อการเจริญเติบโตอย่างสมดุล
หลีกเลี่ยงการทานอาหารหรือขนมที่มีไขมันและน้ำตาลสูง เพื่อไม่ให้เกิดการสะสมไขมันในร่างกาย</h3></p>";
            // เพิ่มคำแนะนำทั้งหมดตามรายละเอียดที่ให้ไปข้างต้น
            break;
        case 'ค่อนข้างผอม':
            echo "<p><strong>คำแนะนำสำหรับเด็กที่ค่อนข้างผอม:</strong> 
            <h3>เด็กที่อยู่ในภาวะค่อนข้างผอมควรได้รับ อาหารที่มีพลังงานสูง เพื่อเพิ่มน้ำหนัก เช่น ข้าว ขนมปัง มันฝรั่ง และอาหารที่มีคาร์โบไฮเดรตสูง
ควรเพิ่มการทาน โปรตีน จากเนื้อสัตว์ที่ไม่ติดมัน ปลา ไข่ และผลิตภัณฑ์จากถั่ว เช่น ถั่วลิสง ถั่วเหลือง
แนะนำให้ทาน นมแม่อย่างต่อเนื่อง พร้อมเสริมอาหารที่มีแคลอรีและโปรตีนสูง เพื่อช่วยในการเพิ่มน้ำหนักอย่างมีประสิทธิภาพ
ควรเพิ่มการทาน ผักและผลไม้ ในทุกมื้อ โดยเฉพาะผักใบเขียวและผลไม้ที่มีน้ำตาลปานกลาง เช่น กล้วย สับปะรด และฝรั่ง
เน้นการทาน อาหารที่มีไขมันดี เช่น อะโวคาโด น้ำมันมะกอก และปลาที่มีไขมันสูง เช่น ปลาแซลมอน เพื่อช่วยเพิ่มพลังงานและบำรุงสุขภาพ
เพิ่มการทาน ผลิตภัณฑ์จากนม เช่น โยเกิร์ต หรือชีส เพื่อให้ได้รับแคลเซียมและโปรตีนเพิ่มเติม
ควรให้เด็กได้รับ การพักผ่อนเพียงพอ เพราะการนอนหลับจะช่วยในการฟื้นฟูและเสริมสร้างร่างกาย
ควรมีการ ติดตามน้ำหนักและส่วนสูง ของเด็กอย่างต่อเนื่อง เพื่อให้มั่นใจว่าการเจริญเติบโตเป็นไปในทิศทางที่เหมาะสม
ลดความเครียด ที่อาจเกิดขึ้นกับเด็ก เช่น การบังคับให้ทานอาหาร ควรทำให้การทานอาหารเป็นกิจกรรมที่สนุกและเพลิดเพลิน
ให้เด็กได้ทานอาหารที่ หลากหลาย และครบถ้วนทั้ง 5 หมู่ เพื่อให้ได้รับสารอาหารที่จำเป็นในการเติบโต
ส่งเสริมการ ออกกำลังกายเบาๆ เช่น การคลานและการเดิน เพื่อเสริมสร้างกล้ามเนื้อและกระดูก
การปรึกษาแพทย์หรือผู้เชี่ยวชาญด้านโภชนาการอาจช่วยในการปรับปรุงอาหารที่เหมาะสมกับความต้องการของเด็กที่มีภาวะค่อนข้างผอม</h3></p>";
            // เพิ่มคำแนะนำทั้งหมดตามรายละเอียดที่ให้ไปข้างต้น
            break;
        case 'ผอม':
            echo "<p><strong>คำแนะนำสำหรับเด็กที่ผอม:</strong> 
            <h3>ควรเพิ่มการทานอาหารที่มี คาร์โบไฮเดรตและพลังงานสูง เช่น ข้าว ขนมปัง และมันฝรั่ง เพื่อเพิ่มน้ำหนักให้เด็ก
แนะนำให้ทาน โปรตีน มากขึ้น เช่น เนื้อสัตว์ ปลา ไข่ และผลิตภัณฑ์จากถั่ว เพื่อเสริมสร้างกล้ามเนื้อและการเจริญเติบโต
เด็กควรได้รับการทาน นมแม่อย่างต่อเนื่อง ร่วมกับอาหารเสริมที่เหมาะสมเมื่ออายุครบ 6 เดือน
ควรเพิ่มการทาน ผักและผลไม้ ที่มีแคลอรีสูง เช่น กล้วย มะม่วง หรือสับปะรด เพื่อเสริมสร้างสุขภาพและเพิ่มพลังงาน
เพิ่มการทาน ไขมันดี จากแหล่งที่ดีต่อสุขภาพ เช่น อะโวคาโด น้ำมันมะกอก และปลาที่มีไขมันดี เช่น ปลาแซลมอน เพื่อเพิ่มพลังงานและบำรุงสมอง
เด็กที่ผอมอาจต้องการการทาน นมที่มีไขมันเต็ม หรือผลิตภัณฑ์จากนม เช่น โยเกิร์ต หรือชีส เพื่อให้ได้รับแคลเซียมและพลังงานเพิ่มเติม
ติดตามน้ำหนัก และส่วนสูงของเด็กอย่างใกล้ชิด เพื่อให้ทราบถึงการเปลี่ยนแปลงและปรับแผนการทานอาหารตามความจำเป็น
ควรให้เด็กได้ พักผ่อนอย่างเพียงพอ เพื่อเสริมสร้างการเจริญเติบโตและการพัฒนาของร่างกาย
การส่งเสริมให้เด็ก ทำกิจกรรมเคลื่อนไหวเบา ๆ เช่น การเล่นหรือการวิ่งเล่น จะช่วยเสริมสร้างกล้ามเนื้อและกระดูก
การปรึกษาผู้เชี่ยวชาญทางโภชนาการหรือแพทย์จะช่วยในการปรับอาหารที่เหมาะสมกับความต้องการของเด็กที่ผอมมาก
พ่อแม่ควรให้ความสำคัญกับการ ทำอาหารที่มีคุณค่าทางโภชนาการ และพยายามจัดเมนูอาหารให้หลากหลาย
หลีกเลี่ยงการ บังคับให้เด็กทานอาหาร เพราะอาจทำให้เด็กเกิดความเครียด ควรทำให้การทานอาหารเป็นเรื่องสนุก</h3></p>";
            // เพิ่มคำแนะนำทั้งหมดตามรายละเอียดที่ให้ไปข้างต้น
            break;
        case 'ผอมมาก':
            echo "<p><strong>คำแนะนำสำหรับเด็กที่ผอมมาก:</strong> 
            <h3>เด็กที่ผอมมากควรได้รับ การทานอาหารที่มีพลังงานสูง เพื่อเพิ่มน้ำหนัก เช่น ข้าว มันฝรั่ง และขนมปังที่ไม่ผ่านการขัดสี
ควรเพิ่มการทาน โปรตีนคุณภาพสูง เช่น เนื้อสัตว์ ปลา ไข่ และผลิตภัณฑ์จากถั่ว เพื่อเสริมสร้างกล้ามเนื้อและน้ำหนัก
การทาน นมแม่อย่างต่อเนื่อง ควรเป็นสิ่งสำคัญ พร้อมกับอาหารเสริมเมื่ออายุครบ 6 เดือนเพื่อช่วยเพิ่มพลังงานและสารอาหารที่จำเป็น
แนะนำให้เพิ่มการทาน ผลไม้และผัก ที่มีแคลอรีสูง เช่น กล้วย มะม่วง เพื่อเสริมสร้างการเจริญเติบโตและสุขภาพ
เน้นการทาน อาหารที่มีไขมันดี เช่น อะโวคาโด น้ำมันมะกอก และปลาแซลมอน เพื่อเสริมสร้างการพัฒนาของสมองและสุขภาพโดยรวม
ควรเพิ่มการทาน นมและผลิตภัณฑ์จากนม เช่น โยเกิร์ตและชีส เพื่อเพิ่มแคลเซียมและพลังงานให้กับร่างกาย
การพักผ่อนที่เพียงพอมีความสำคัญต่อการเจริญเติบโตของเด็ก ควร ดูแลให้เด็กได้นอนหลับเพียงพอ
ติดตามน้ำหนัก และส่วนสูงของเด็กอย่างใกล้ชิด เพื่อตรวจสอบว่ามีการเปลี่ยนแปลงหรือไม่ และปรับการทานอาหารตามความจำเป็น
ควรหลีกเลี่ยงการ บังคับทานอาหาร ควรให้เด็กทานอาหารในบรรยากาศที่เป็นมิตรและไม่กดดัน
หากเด็กไม่สามารถเพิ่มน้ำหนักได้ตามเกณฑ์ ควร ปรึกษาแพทย์หรือผู้เชี่ยวชาญด้านโภชนาการ เพื่อวางแผนการดูแลที่เหมาะสม
ส่งเสริมให้เด็กทำ กิจกรรมที่เคลื่อนไหวเบาๆ เช่น การคลาน การเดินเล่น เพื่อเสริมสร้างกล้ามเนื้อและพัฒนากล้ามเนื้อ
ควรสร้าง เมนูอาหารที่หลากหลาย และเพิ่มความสนุกในการทานอาหาร เพื่อให้เด็กได้รับสารอาหารครบถ้วนและเพลิดเพลินกับการทานอาหาร</h3></p>";
            // เพิ่มคำแนะนำทั้งหมดตามรายละเอียดที่ให้ไปข้างต้น
            break;
        default:
            echo "<p>ไม่พบคำแนะนำสำหรับภาวะโภชนาการนี้.</p>";
    }
    ?>
</div>



</body>
</html>
