document.getElementById('kidBirth').addEventListener('change', function () {
    var birthDate = new Date(this.value);
    var today = new Date();
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    document.getElementById('KidAge').value = age;
});

function validateForm() {
    var DadFirstname = document.forms["info-form"]["DadFirstname"].value;
    var MomFirstname = document.forms["info-form"]["MomFirstname"].value;
    var KidFirstname = document.forms["info-form"]["KidFirstname"].value;
    
    if (DadFirstname == "" || MomFirstname == "" || KidFirstname == "") {
        alert("กรุณากรอกข้อมูลที่จำเป็น");
        return false;
    }
    return true;
}
