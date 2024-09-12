// main.js
$(document).ready(function() {
    if (!session_id() || !$_SESSION['id'] || !$_SESSION['email']) {
        setTimeout(function() {
            swal({
                title: "คุณไม่มีสิทธิ์ใช้งานหน้านี้",
                type: "error"
            }, function() {
                window.location = "login.php";
            });
        }, 1000);
    }
});
