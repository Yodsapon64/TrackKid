<?php
session_start();
include 'connect.php'; // เชื่อมต่อกับฐานข้อมูล
 
 
$user_id = $_SESSION['user_id'];
 
// ดึงข้อมูลผู้ปกครองจากตาราง parent
$sqlParent = "SELECT ParentFirstname, ParentLastname, ParentStatus FROM parent WHERE user_id = :user_id";
$stmtParent = $conn->prepare($sqlParent);
$stmtParent->bindParam(':user_id', $user_id);
$stmtParent->execute();
$rowParent = $stmtParent->fetch(PDO::FETCH_ASSOC);
 
// ตรวจสอบว่าพบข้อมูลผู้ปกครองหรือไม่
$parentInfo = $rowParent ? $rowParent : ['ParentFirstname' => 'ไม่ระบุ', 'ParentLastname' => 'ไม่ระบุ', 'ParentStatus' => 'ไม่ระบุ'];
 
// ตรวจสอบว่าผู้ใช้มีข้อมูลในตาราง parent หรือไม่
$sql = "SELECT * FROM parent WHERE user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
 
$profile_link = $stmt->rowCount() > 0 ? "view_profile.php" : "profile.php";
 
 
// ฟังก์ชันสำหรับการประเมินภาวะโภชนาการ
function evaluateNutritionStatus($weight, $height, $sd_data) {
    $closest_height = null;
    $closest_diff = PHP_INT_MAX;
 
    foreach ($sd_data as $data_point) {
        $diff = abs($data_point['height'] - $height);
        if ($diff < $closest_diff) {
            $closest_height = $data_point;
            $closest_diff = $diff;
        }
    }
 
    // ตรวจสอบว่าน้ำหนักเด็กอยู่ในช่วง SD ใด
    if ($weight > $closest_height['+3SD']) {
        return 'อ้วน';
    } elseif ($weight > $closest_height['+2SD']) {
        return 'เริ่มอ้วน';
    } elseif ($weight > $closest_height['+1.5SD']) {
        return 'ท้วม';
    } elseif ($weight > $closest_height['Median']) {
        return 'สมส่วน';
    } elseif ($weight > $closest_height['-1.5SD']) {
        return 'ค่อนข้างผอม';
    } elseif ($weight > $closest_height['-2SD']) {
        return 'ผอม';
    } else {
        return 'ผอมมาก';
    }
}
 
 
$sd_data = [
    ['height' => 45, '+3SD' => 3.3, '+2SD' => 3, '+1.5SD' => 2.8, 'Median' => 2.5, '-1.5SD' => 2.2, '-2SD' => 2],
    ['height' => 46, '+3SD' => 3.5, '+2SD' => 3.2, '+1.5SD' => 3, 'Median' => 2.6, '-1.5SD' => 2.3, '-2SD' => 2.2],
    ['height' => 47, '+3SD' => 3.8, '+2SD' => 3.4, '+1.5SD' => 3.2, 'Median' => 2.8, '-1.5SD' => 2.5, '-2SD' => 2.4],
    ['height' => 48, '+3SD' => 3.9, '+2SD' => 3.5, '+1.5SD' => 3.4, 'Median' => 3, '-1.5SD' => 2.6, '-2SD' => 2.5],
    ['height' => 49, '+3SD' => 4.2, '+2SD' => 3.8, '+1.5SD' => 3.6, 'Median' => 3.1, '-1.5SD' => 2.8, '-2SD' => 2.7],
    ['height' => 50, '+3SD' => 4.5, '+2SD' => 4, '+1.5SD' => 3.8, 'Median' => 3.4, '-1.5SD' => 3, '-2SD' => 2.9],
    ['height' => 51, '+3SD' => 4.7, '+2SD' => 4.3, '+1.5SD' => 4, 'Median' => 3.5, '-1.5SD' => 3.1, '-2SD' => 3],
    ['height' => 52, '+3SD' => 5, '+2SD' => 4.5, '+1.5SD' => 4.3, 'Median' => 3.8, '-1.5SD' => 3.4, '-2SD' => 3.2],
    ['height' => 53, '+3SD' => 5.3, '+2SD' => 4.8, '+1.5SD' => 4.5, 'Median' => 4, '-1.5SD' => 3.5, '-2SD' => 3.4],
    ['height' => 54, '+3SD' => 5.5, '+2SD' => 5.1, '+1.5SD' => 4.9, 'Median' => 4.3, '-1.5SD' => 3.8, '-2SD' => 3.6],
    ['height' => 55, '+3SD' => 6, '+2SD' => 5.5, '+1.5SD' => 5.1, 'Median' => 4.5, '-1.5SD' => 4, '-2SD' => 3.8],
    ['height' => 56, '+3SD' => 6.4, '+2SD' => 5.8, '+1.5SD' => 5.5, 'Median' => 4.9, '-1.5SD' => 4.3, '-2SD' => 4.1],
    ['height' => 57, '+3SD' => 6.7, '+2SD' => 6.1, '+1.5SD' => 5.9, 'Median' => 5.1, '-1.5SD' => 4.5, '-2SD' => 4.4],
    ['height' => 58, '+3SD' => 7, '+2SD' => 6.5, '+1.5SD' => 6.1, 'Median' => 5.5, '-1.5SD' => 4.8, '-2SD' => 4.5],
    ['height' => 59, '+3SD' => 7.5, '+2SD' => 6.9, '+1.5SD' => 6.5, 'Median' => 5.8, '-1.5SD' => 5, '-2SD' => 4.9],
    ['height' => 60, '+3SD' => 7.8, '+2SD' => 7.1, '+1.5SD' => 6.8, 'Median' => 6, '-1.5SD' => 5.3, '-2SD' => 5.1],
    ['height' => 61, '+3SD' => 8.1, '+2SD' => 7.5, '+1.5SD' => 7.1, 'Median' => 6.3, '-1.5SD' => 5.5, '-2SD' => 5.3],
    ['height' => 62, '+3SD' => 8.5, '+2SD' => 7.8, '+1.5SD' => 7.5, 'Median' => 6.5, '-1.5SD' => 5.8, '-2SD' => 5.5],
    ['height' => 63, '+3SD' => 8.8, '+2SD' => 8, '+1.5SD' => 7.7, 'Median' => 6.8, '-1.5SD' => 6, '-2SD' => 5.8],
    ['height' => 64, '+3SD' => 9, '+2SD' => 8.3, '+1.5SD' => 8, 'Median' => 7, '-1.5SD' => 6.3, '-2SD' => 6],
    ['height' => 65, '+3SD' => 9.5, '+2SD' => 8.5, '+1.5SD' => 8.3, 'Median' => 7.3, '-1.5SD' => 6.5, '-2SD' => 6.2],
    ['height' => 66, '+3SD' => 9.8, '+2SD' => 8.9, '+1.5SD' => 8.5, 'Median' => 7.5, '-1.5SD' => 6.7, '-2SD' => 6.5],
    ['height' => 67, '+3SD' => 10, '+2SD' => 9.2, '+1.5SD' => 8.8, 'Median' => 7.8, '-1.5SD' => 6.9, '-2SD' => 6.6],
    ['height' => 68, '+3SD' => 10.3, '+2SD' => 9.5, '+1.5SD' => 9, 'Median' => 8, '-1.5SD' => 7, '-2SD' => 6.8],
    ['height' => 69, '+3SD' => 10.5, '+2SD' => 9.8, '+1.5SD' => 9.3, 'Median' => 8.2, '-1.5SD' => 7.3, '-2SD' => 7],
    ['height' => 70, '+3SD' => 11, '+2SD' => 10, '+1.5SD' => 9.5, 'Median' => 8.5, '-1.5SD' => 7.5, '-2SD' => 7.3],
    ['height' => 71, '+3SD' => 11.2, '+2SD' => 10.3, '+1.5SD' => 9.9, 'Median' => 8.6, '-1.5SD' => 7.6, '-2SD' => 7.4],
    ['height' => 72, '+3SD' => 11.5, '+2SD' => 10.5, '+1.5SD' => 10, 'Median' => 8.9, '-1.5SD' => 7.9, '-2SD' => 7.5],
    ['height' => 73, '+3SD' => 11.8, '+2SD' => 10.8, '+1.5SD' => 10.4, 'Median' => 9, '-1.5SD' => 8, '-2SD' => 7.8],
    ['height' => 74, '+3SD' => 12, '+2SD' => 11, '+1.5SD' => 10.5, 'Median' => 9.4, '-1.5SD' => 8.3, '-2SD' => 7.9],
    ['height' => 75, '+3SD' => 12.4, '+2SD' => 11.3, '+1.5SD' => 10.8, 'Median' => 9.5, '-1.5SD' => 8.4, '-2SD' => 8.1],
    ['height' => 76, '+3SD' => 12.5, '+2SD' => 11.5, '+1.5SD' => 11, 'Median' => 9.7, '-1.5SD' => 8.5, '-2SD' => 8.3],
    ['height' => 77, '+3SD' => 12.9, '+2SD' => 11.8, '+1.5SD' => 11.2, 'Median' => 10, '-1.5SD' => 8.8, '-2SD' => 8.4],
    ['height' => 78, '+3SD' => 13, '+2SD' => 12, '+1.5SD' => 11.5, 'Median' => 10.1, '-1.5SD' => 9, '-2SD' => 8.5],
    ['height' => 79, '+3SD' => 13.4, '+2SD' => 12.2, '+1.5SD' => 11.6, 'Median' => 10.3, '-1.5SD' => 9.1, '-2SD' => 8.8],
    ['height' => 80, '+3SD' => 13.5, '+2SD' => 12.5, '+1.5SD' => 11.9, 'Median' => 10.5, '-1.5SD' => 9.3, '-2SD' => 8.9],
    ['height' => 81, '+3SD' => 13.8, '+2SD' => 12.6, '+1.5SD' => 12, 'Median' => 10.6, '-1.5SD' => 9.5, '-2SD' => 9],
    ['height' => 82, '+3SD' => 14, '+2SD' => 12.9, '+1.5SD' => 12.3, 'Median' => 10.9, '-1.5SD' => 9.6, '-2SD' => 9.3],
    ['height' => 83, '+3SD' => 14.3, '+2SD' => 13, '+1.5SD' => 12.5, 'Median' => 11, '-1.5SD' => 9.8, '-2SD' => 9.5],
    ['height' => 84, '+3SD' => 14.5, '+2SD' => 13.4, '+1.5SD' => 12.8, 'Median' => 11.3, '-1.5SD' => 10, '-2SD' => 9.6],
    ['height' => 85, '+3SD' => 14.9, '+2SD' => 13.5, '+1.5SD' => 13, 'Median' => 11.5, '-1.5SD' => 10.2, '-2SD' => 9.8],
    ['height' => 86, '+3SD' => 15.2, '+2SD' => 13.9, '+1.5SD' => 13.4, 'Median' => 11.8, '-1.5SD' => 10.5, '-2SD' => 10],
    ['height' => 87, '+3SD' => 15.5, '+2SD' => 14.2, '+1.5SD' => 13.5, 'Median' => 12, '-1.5SD' => 10.6, '-2SD' => 10.3],
    ['height' => 88, '+3SD' => 15.8, '+2SD' => 14.5, '+1.5SD' => 13.9, 'Median' => 12.3, '-1.5SD' => 10.9, '-2SD' => 10.5],
    ['height' => 89, '+3SD' => 16, '+2SD' => 14.8, '+1.5SD' => 14.1, 'Median' => 12.5, '-1.5SD' => 11.1, '-2SD' => 10.6],
    ['height' => 90, '+3SD' => 16.5, '+2SD' => 15, '+1.5SD' => 14.4, 'Median' => 12.8, '-1.5SD' => 11.3, '-2SD' => 10.9],
    ['height' => 91, '+3SD' => 16.6, '+2SD' => 15.4, '+1.5SD' => 14.6, 'Median' => 13, '-1.5SD' => 11.5, '-2SD' => 11],
    ['height' => 92, '+3SD' => 17, '+2SD' => 15.5, '+1.5SD' => 15, 'Median' => 13.1, '-1.5SD' => 11.8, '-2SD' => 11.3],
    ['height' => 93, '+3SD' => 17.3, '+2SD' => 15.9, '+1.5SD' => 15.2, 'Median' => 13.5, '-1.5SD' => 12, '-2SD' => 11.5],
    ['height' => 94, '+3SD' => 17.5, '+2SD' => 16.1, '+1.5SD' => 15.5, 'Median' => 13.6, '-1.5SD' => 12.1, '-2SD' => 11.6],
    ['height' => 95, '+3SD' => 18, '+2SD' => 16.5, '+1.5SD' => 15.7, 'Median' => 13.9, '-1.5SD' => 12.4, '-2SD' => 11.9],
    ['height' => 96, '+3SD' => 18.2, '+2SD' => 16.6, '+1.5SD' => 16, 'Median' => 14, '-1.5SD' => 12.5, '-2SD' => 12],
    ['height' => 97, '+3SD' => 18.5, '+2SD' => 17, '+1.5SD' => 16.3, 'Median' => 14.4, '-1.5SD' => 12.8, '-2SD' => 12.3],
    ['height' => 98, '+3SD' => 19, '+2SD' => 17.3, '+1.5SD' => 16.5, 'Median' => 14.6, '-1.5SD' => 13, '-2SD' => 12.5],
    ['height' => 99, '+3SD' => 19.2, '+2SD' => 17.5, '+1.5SD' => 16.9, 'Median' => 14.9, '-1.5SD' => 13.2, '-2SD' => 12.7],
    ['height' => 100, '+3SD' => 19.5, '+2SD' => 18, '+1.5SD' => 17.1, 'Median' => 15.1, '-1.5SD' => 13.5, '-2SD' => 12.9],
    ['height' => 101, '+3SD' => 20, '+2SD' => 18.3, '+1.5SD' => 17.5, 'Median' => 15.5, '-1.5SD' => 13.6, '-2SD' => 13.1],
    ['height' => 102, '+3SD' => 20.5, '+2SD' => 18.7, '+1.5SD' => 17.9, 'Median' => 15.8, '-1.5SD' => 14, '-2SD' => 13.4],
    ['height' => 103, '+3SD' => 20.8, '+2SD' => 19, '+1.5SD' => 18.2, 'Median' => 16, '-1.5SD' => 14.2, '-2SD' => 13.6],
    ['height' => 104, '+3SD' => 21.2, '+2SD' => 19.4, '+1.5SD' => 18.5, 'Median' => 16.4, '-1.5SD' => 14.5, '-2SD' => 13.9],
    ['height' => 105, '+3SD' => 21.5, '+2SD' => 19.8, '+1.5SD' => 19, 'Median' => 16.5, '-1.5SD' => 14.6, '-2SD' => 14],
    ['height' => 106, '+3SD' => 22, '+2SD' => 20.2, '+1.5SD' => 19.4, 'Median' => 16.9, '-1.5SD' => 15, '-2SD' => 14.4],
    ['height' => 107, '+3SD' => 22.5, '+2SD' => 20.5, '+1.5SD' => 19.6, 'Median' => 17.3, '-1.5SD' => 15.2, '-2SD' => 14.5],
    ['height' => 108, '+3SD' => 23, '+2SD' => 21, '+1.5SD' => 20, 'Median' => 17.5, '-1.5SD' => 15.5, '-2SD' => 14.9],
    ['height' => 109, '+3SD' => 23.5, '+2SD' => 21.5, '+1.5SD' => 20.5, 'Median' => 18, '-1.5SD' => 15.8, '-2SD' => 15.2],
    ['height' => 110, '+3SD' => 24, '+2SD' => 22, '+1.5SD' => 20.9, 'Median' => 18.3, '-1.5SD' => 16, '-2SD' => 15.4],
];
 
 
 
// ตรวจสอบว่ามี id ถูกส่งผ่าน session หรือไม่
if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
 
    // คำสั่ง SQL เพื่อดึงข้อมูลจากฐานข้อมูล
    $sql = "SELECT * FROM kid WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $id);
    $stmt->execute();
 
    // ดึงข้อมูลจากฐานข้อมูล
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
   
    if ($row) {
        $kidFirstname = $row['KidFirstname'];
        $kidLastname = $row['KidLastname'];
        $kidBirth = $row['KidBirth'];
        $kidAge = $row['KidAge'];
        $kidGender = $row['KidGender'];
        $bloodType = $row['BloodType'];
        $weight = (float)$row['Weight']; // น้ำหนัก
        $height = (float)$row['KidHeight']; // ส่วนสูง
 
        // ประเมินภาวะโภชนาการ
        $nutritionStatus = evaluateNutritionStatus($weight, $height, $sd_data);
    } else {
        echo "ไม่พบข้อมูลของเด็ก!! กรุณากรอกเพิ่มข้อมูลผู้ใช้งานก่อนเข้าดูการประเมินภาวะโภชนาการของเด็ก";
        exit();
    }
} else {
    echo "ไม่มี ID ถูกส่งมา";
    exit();
}
 
// ดึงข้อมูลเด็กทั้งหมดที่เชื่อมโยงกับผู้ใช้
$stmtKids = $conn->prepare("SELECT kid_id, KidFirstname, KidLastname FROM kid WHERE user_id = :user_id");
$stmtKids->bindParam(':user_id', $usAXer_id, PDO::PARAM_INT);
$stmtKids->execute();
$kids = $stmtKids->fetchAll(PDO::FETCH_ASSOC);
 
// ตรวจสอบข้อมูลเด็กที่เลือก
$selected_kid = null;
if (isset($_GET['kid_id'])) {
    $kid_id = $_GET['kid_id'];
    $stmtSelectedKid = $conn->prepare("SELECT * FROM kid WHERE kid_id = :kid_id AND user_id = :user_id");
    $stmtSelectedKid->bindParam(':kid_id', $kid_id, PDO::PARAM_INT);
    $stmtSelectedKid->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmtSelectedKid->execute();
    $selected_kid = $stmtSelectedKid->fetch(PDO::FETCH_ASSOC);
}

?>
 
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลภาวะโภชนาการ</title>
    <link rel="stylesheet" href="Css/nutritional.css">
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
            <li><a href="dad.php">เพิ่มข้อมูลผู้ใช้งาน</a></li>
            <li><a href="<?php echo $profile_link; ?>">ยินดีต้อนรับ <?php echo htmlspecialchars($_SESSION['username']); ?></a></li>
        </ul>
    </div>
 
    <div class="container">
        <div class="profile-card">
            <div class="profile-header">
                <h2>ข้อมูลส่วนตัวเด็ก</h2>
            </div>

            <!-- ฟอร์มเลือกเด็ก -->
            <form method="GET" action="kid.php">
                <label for="kid">เลือกเด็ก:</label>
                <select name="kid_id" id="kid" onchange="this.form.submit()">
                    <option value="">-- กรุณาเลือกเด็ก --</option>
                    <?php foreach ($kids as $kid): ?>
                        <option value="<?= $kid['kid_id'] ?>" <?= isset($kid_id) && $kid_id == $kid['kid_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($kid['KidFirstname'] . " " . $kid['KidLastname']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>

            <!-- แสดงข้อมูลเด็กที่เลือก -->
            <?php if ($selected_kid): ?>
                <h3>รายละเอียดข้อมูลส่วนตัวเด็ก</h3>
                <p>ชื่อ: <?= htmlspecialchars($selected_kid['KidFirstname'] . " " . $selected_kid['KidLastname']) ?></p>
                <p>วันเกิด: <?= htmlspecialchars($selected_kid['KidBirth']) ?></p>
                <p>อายุ: <?= htmlspecialchars($selected_kid['KidAge']) ?> ปี</p>
                <p>เพศ: <?= htmlspecialchars($selected_kid['KidGender']) ?></p>
                <p>กรุ๊ปเลือด: <?= htmlspecialchars($selected_kid['BloodType']) ?></p>
                <p>น้ำหนัก: <?= htmlspecialchars($selected_kid['Weight']) ?> กก.</p>
                <p>ส่วนสูง: <?= htmlspecialchars($selected_kid['KidHeight']) ?> ซม.</p>
                <p><strong>อัพเดทข้อมูลโดย:</strong>
                <?= htmlspecialchars($parentInfo['ParentFirstname'] . ' ' . $parentInfo['ParentLastname']); ?>
                (<?= htmlspecialchars($parentInfo['ParentStatus']); ?>)
            </p>
            <p>วันที่อัปเดตข้อมูลล่าสุด: <?= htmlspecialchars($selected_kid['UpdateDate']); ?></p>
            <?php else: ?>
                <p>กรุณาเลือกเด็กเพื่อแสดงข้อมูล</p>
            <?php endif; ?>

            <a href="kid.php" class="btn btn-primary">เพิ่มข้อมูลเด็ก</a>
        </div>
    </div>

       
 
       
        <div class="chart-card">
        <div class="chart-header">
        <h2>กราฟแสดงภาวะโภชนาการ</h2>
        </div>
        <div class="chart-content">
        <canvas id="nutritionChart" width="200" height="100"></canvas>
       
 
        <script>
        const sdData = <?php echo json_encode($sd_data); ?>;
        const weight = <?php echo $weight; ?>;
        const height = <?php echo $height; ?>;
       
        const heights = sdData.map(point => point.height);
        const medianWeights = sdData.map(point => point.Median);
        const sd1_5Weights = sdData.map(point => point['+1.5SD']);
        const sd2Weights = sdData.map(point => point['+2SD']);
        const sd3Weights = sdData.map(point => point['+3SD']);
        const sd1_5WeightsNeg = sdData.map(point => point['-1.5SD']);
        const sd2WeightsNeg = sdData.map(point => point['-2SD']);
       
        const ctx = document.getElementById('nutritionChart').getContext('2d');
const nutritionChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: heights,  // ความสูงที่กำหนดไว้
        datasets: [
            {
                label: 'Above +3 SD',
                data: Array(heights.length).fill(30),  // ข้อมูลที่เติมเพื่อแสดงพื้นที่ด้านบนสุด
                borderColor: 'rgba(255, 255, 255, 0)',  // ไม่แสดงเส้น
                backgroundColor: 'rgba(255, 0, 0, 0.1)',  // สีแดงโปร่งใส
                fill: '+3',  // เติมสีจากเส้น +3 SD ไปถึงเส้นบนสุด
            },
            {
                label: '+3 SD',
                data: sd3Weights,
                borderColor: 'red',
                backgroundColor: 'rgba(255, 0, 0, 0.2)',  // สีแดงโปร่งใส
                fill: '+2',
            },
            {
                label: '+2 SD',
                data: sd2Weights,
                borderColor: 'orange',
                backgroundColor: 'rgba(255, 165, 0, 0.2)',  // สีส้มโปร่งใส
                fill: '+1',
            },
            {
                label: '+1.5 SD',
                data: sd1_5Weights,
                borderColor: 'yellow',
                backgroundColor: 'rgba(255, 255, 0, 0.2)',  // สีเหลืองโปร่งใส
                fill: 'origin',
            },
            {
                label: 'Median',
                data: medianWeights,
                borderColor: 'green',
                backgroundColor: 'rgba(0, 255, 0, 0.2)',  // สีเขียวโปร่งใส
                fill: false,
            },
            {
                label: '-1.5 SD',
                data: sd1_5WeightsNeg,
                borderColor: 'blue',
                backgroundColor: 'rgba(0, 0, 255, 0.2)',  // สีน้ำเงินโปร่งใส
                fill: 'origin',
            },
            {
                label: '-2 SD',
                data: sd2WeightsNeg,
                borderColor: 'purple',
                backgroundColor: 'rgba(128, 0, 128, 0.2)',  // สีม่วงโปร่งใส
                fill: '-1',
            },
            // เพิ่มข้อมูลใหม่ที่เป็นจุดเดียว
            {
                label: 'น้ำหนักของเด็ก',
                data: [{x: height, y: weight}],  // เพิ่มจุดพล็อตตำแหน่งเดียว
                borderColor: 'black',
                backgroundColor: 'black',
                pointStyle: 'circle',
                pointRadius: 8,  // ขนาดจุดใหญ่ขึ้น
                pointHoverRadius: 10,  // ขนาดจุดเมื่อเอาเมาส์ไปวาง
                fill: false,
                showLine: false  // ไม่แสดงเส้น
            }
        ]
    } ,
    options: {
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'ความสูง (cm)',
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'น้ำหนัก (kg)',
                },
                ticks: {
                    stepSize: 1,  // ระดับน้ำหนักเพิ่มทีละ 1
                    beginAtZero: true,  // เริ่มจาก 0
                    max: 30,
                }
            }
        }
    }
});
       
        </script>
 
 
 
<center><a href="advice.php?status=<?php echo $nutritionStatus; ?>&name=<?php echo urlencode($kidFirstname . ' ' . $kidLastname); ?>&birth=<?php echo urlencode($kidBirth); ?>&age=<?php echo urlencode($kidAge); ?>&gender=<?php echo urlencode($kidGender); ?>&weight=<?php echo $weight; ?>&height=<?php echo $height; ?>" class="advice-button"><p>ภาวะโภชนาการ <h2><strong><?php echo $nutritionStatus; ?></strong></h2></p> โปรดดูดูคำแนะนำ</a></center>
 
 
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