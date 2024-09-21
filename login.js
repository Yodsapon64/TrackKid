// login.js
function showSuccessAlert() {
    setTimeout(function() {
        swal({
            title: "รหัสผ่านถูกต้อง",
            text: "กำลังเข้าสู่ระบบ",
            type: "success"
        }, function() {
            window.location = "main.php";
        });
    }, 1000);
}

function showErrorAlert() {
    setTimeout(function() {
        swal({
            title: "เกิดข้อผิดพลาด",
            text: "Username หรือ Password ไม่ถูกต้อง ลองใหม่อีกครั้ง",
            type: "warning"
        }, function() {
            window.location = "login.php";
        });
    }, 1000);
}
