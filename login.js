// login.js
document.addEventListener('DOMContentLoaded', function() {
    // Check if there's a message to show
    const messageType = document.getElementById('messageType').value;
    const messageText = document.getElementById('messageText').value;

    if (messageType && messageText) {
        setTimeout(function() {
            swal({
                title: "เกิดข้อผิดพลาด",
                text: messageText,
                type: messageType
            }, function() {
                window.location = "login.php";
            });
        }, 1000);
    }
});
