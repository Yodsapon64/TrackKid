<?php
include 'connect.php';

// Query the database to get all the info records
$sql = "SELECT * FROM info";
$stmt = $conn->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลภาวะโภชนาการ</title>
    <link rel="stylesheet" href="Css/nutritional.css">
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

    <div class="form-container">
        <h2>ข้อมูลภาวะโภชนาการ</h2>
        
        <?php if (count($results) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ชื่อเด็ก</th>
                        <th>วันเกิด</th>
                        <th>น้ำหนัก (กิโลกรัม)</th>
                        <th>ส่วนสูง (เซนติเมตร)</th>
                        <th>เพศ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['KidFirstname'] . ' ' . $row['KidLastname']); ?></td>
                            <td><?php echo date("d-m-Y", strtotime($row['KidBirth'])); ?></td>
                            <td><?php echo htmlspecialchars($row['Weight']); ?></td>
                            <td><?php echo htmlspecialchars($row['KidHeight']); ?></td>
                            <td><?php echo htmlspecialchars($row['KidGender']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>ยังไม่มีข้อมูล</p>
        <?php endif; ?>
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
