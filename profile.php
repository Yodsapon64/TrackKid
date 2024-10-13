<?php
session_start();
include 'connect.php'; // เชื่อมต่อกับฐานข้อมูล

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
if (!isset($_SESSION['username'])) {
    header("Location: profile.php");
    exit();
}

// ตรวจสอบว่ามีการส่งข้อมูลด้วยวิธี POST หรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าจากฟอร์ม
    $ParentFirstname = $_POST['ParentFirstname'];
    $ParentLastname = $_POST['ParentLastname'];
    $ParentStatus = $_POST['ParentStatus'];
    $ParentAge = $_POST['ParentAge'];
    $ParentTel = $_POST['ParentTel'];
    $user_id = $_POST['user_id'];

    if (isset($_GET['id'])) {
        // ถ้ามีการกำหนด id แสดงว่าเป็นการแก้ไขข้อมูล
        $parent_id = $_GET['parent_id'];
        $sql = "UPDATE parent SET ParentFirstname = :ParentFirstname, ParentLastname = :ParentLastname, ParentStatus = :ParentStatus, ParentAge = :ParentAge, ParentTel = :ParentTel WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ParentFirstname', $ParentFirstname);
        $stmt->bindParam(':ParentLastname', $ParentLastname);
        $stmt->bindParam(':ParentStatus', $ParentStatus);
        $stmt->bindParam(':ParentAge', $ParentAge);
        $stmt->bindParam(':ParentTel', $ParentTel);
        $stmt->bindParam(':parent_id', $parent_id);

        if ($stmt->execute()) {
            header("Location: main.php?id=$id");
            exit();
        } else {
            echo "เกิดข้อผิดพลาดในการอัปเดตข้อมูล";
        }
    } else {
        // ถ้าไม่มี id แสดงว่าเป็นการเพิ่มข้อมูลใหม่
        $sql = "INSERT INTO parent (ParentFirstname, ParentLastname, ParentStatus, ParentAge, ParentTel)
                VALUES (:ParentFirstname, :ParentLastname, :ParentStatus, :ParentAge, :ParentTel)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ParentFirstname', $ParentFirstname);
        $stmt->bindParam(':ParentLastname', $ParentLastname);
        $stmt->bindParam(':ParentStatus', $ParentStatus);
        $stmt->bindParam(':ParentAge', $ParentAge);
        $stmt->bindParam(':ParentTel', $ParentTel);

        if ($stmt->execute()) {
            $last_id = $conn->lastInsertId();
            header("Location: main.php?id=$last_id");
            exit();
        } else {
            echo "เกิดข้อผิดพลาดในการเพิ่มข้อมูล";
        }
    }
}

// ถ้ามีการส่ง id มา แสดงว่าเป็นการแก้ไขข้อมูล
if (isset($_GET['parent_id'])) {
    $id = $_GET['parent_id'];
    // ดึงข้อมูลจากฐานข้อมูลมาแสดงในฟอร์ม
    $sql = "SELECT * FROM parent WHERE parent_id = :parent_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':parent_id', $parent_id);
    $stmt->execute();
    $parent = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่ม/แก้ไขข้อมูลโปรไฟล์</title>
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
            <li><a href="logout.php" onclick="return confirm('ยืนยันการออกจากระบบ');">ออกจากระบบ</a></li>
            <li><a href="profile.php">ยินดีต้อนรับ <?php echo $_SESSION['username']; ?></a></li>
        </ul>
    </div>

    <div class="form-container">
        <h2><?php echo isset($parent) ? 'แก้ไขข้อมูลโปรไฟล์' : 'เพิ่มข้อมูลโปรไฟล์'; ?></h2>
        <form action="" method="post" class="info-form">
            <div class="section-title">ข้อมูลผู้ปกครอง</div>
            <input type="text" name="ParentFirstname" placeholder="ชื่อ" required value="<?php echo isset($parent['ParentFirstname']) ? $parent['ParentFirstname'] : ''; ?>">
            <input type="text" name="ParentLastname" placeholder="นามสกุล" required value="<?php echo isset($parent['ParentLastname']) ? $parent['ParentLastname'] : ''; ?>">
            <select name="ParentStatus" required>
                <option value="">-- สถานะ --</option>
                <option value="บิดา" <?php if(isset($parent['ParentStatus']) && $parent['ParentStatus'] == 'บิดา') echo 'selected'; ?>>บิดา</option>
                <option value="มารดา" <?php if(isset($parent['ParentStatus']) && $parent['ParentStatus'] == 'มารดา') echo 'selected'; ?>>มารดา</option>
                <option value="ผู้ปกครอง" <?php if(isset($parent['ParentStatus']) && $parent['ParentStatus'] == 'ผู้ปกครอง') echo 'selected'; ?>>ผู้ปกครอง</option>
            </select>
            <input type="number" name="ParentAge" placeholder="อายุ" required value="<?php echo isset($parent['ParentAge']) ? $parent['ParentAge'] : ''; ?>">
            <input type="tel" name="ParentTel" placeholder="เบอร์โทร" required value="<?php echo isset($parent['ParentTel']) ? $parent['ParentTel'] : ''; ?>">

            <button type="submit" name="sub" class="sub"><?php echo isset($parent) ? 'อัปเดตข้อมูล' : 'บันทึกข้อมูล'; ?></button>
        </form>
    </div>

    <footer class="footer">
        <div class="footer-container">
            <p>© 2024 เว็บแอปพลิเคชันสำหรับติดตามการเจริญเติบโตของเด็กอายุ 0-12 ปี. All rights reserved.</p>
            <ul class="footer-menu">
                <li><a href="privacy.php">นโยบายความเป็นส่วนตัว</a></li>
                <li><a href="terms.php">เงื่อนไขการให้บริการ</a></li>
                <li><a href="contact.php">ติดต่อเรา</a></li>
            </ul>
        </div>
    </footer>
</body>
</html>
