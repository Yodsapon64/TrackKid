// ตรวจสอบว่าไม่มีการใช้ชื่อบิดา, มารดา, และเด็กเหมือนกัน
function validateForm() {
            const DadFirstname = document.querySelector('input[name="DadFirstname"]').value;
            const MomFirstname = document.querySelector('input[name="MomFirstname"]').value;
            const KidFirstname = document.querySelector('input[name="KidFirstname"]').value;
        
            const DadTel = document.querySelector('input[name="DadTel"]').value;
            const MomTel = document.querySelector('input[name="MomTel"]').value;
        
            // ตรวจสอบไม่ให้ชื่อบิดา มารดา และเด็กเหมือนกัน
            if (DadFirstname === MomFirstname || DadFirstname === KidFirstname || MomFirstname === KidFirstname) {
                alert('ชื่อบิดา, มารดา, และชื่อเด็กต้องไม่เหมือนกัน');
                return false;
            }
        
            // ตรวจสอบไม่ให้เบอร์โทรของบิดาและมารดาเหมือนกัน
            if (DadTel === MomTel) {
                alert('เบอร์โทรของบิดาและมารดาต้องไม่เหมือนกัน');
                return false;
            }
        
            // ตรวจสอบว่าชื่อและนามสกุลไม่มีตัวเลข
            const nameFields = ['DadFirstname', 'DadLastname', 'MomFirstname', 'MomLastname', 'KidFirstname', 'KidLastname'];
            const regex = /^[A-Za-zก-ฮะ-์]+$/; // อนุญาตเฉพาะตัวอักษรไทยและอังกฤษ
        
            for (let field of nameFields) {
                const value = document.querySelector(`input[name="${field}"]`).value;
                if (!regex.test(value)) {
                    alert('ชื่อและนามสกุลต้องประกอบด้วยตัวอักษรเท่านั้น');
                    return false;
                }
            }
        
            return true;
        }
        
        // ฟังก์ชันจำกัดการใส่ตัวเลขในชื่อและนามสกุล
        function restrictNonLetters(inputField) {
            const regex = /[^A-Za-zก-ฮะ-์]/g; // อนุญาตเฉพาะตัวอักษรไทยและอังกฤษ
            inputField.addEventListener('input', function() {
                this.value = this.value.replace(regex, ''); // ลบตัวอักษรที่ไม่ใช่ตัวอักษรออก
            });
        }
        
        // ตั้งค่า Flatpickr และจำกัดการป้อนข้อมูล
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr("#kidBirth", {
                dateFormat: "Y-m-d",
                maxDate: "today",
                locale: {
                    firstDayOfWeek: 1, // วันจันทร์เป็นวันแรกของสัปดาห์
                    weekdays: {
                        shorthand: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"],
                        longhand: ["อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์"]
                    },
                    months: {
                        shorthand: ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."],
                        longhand: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"]
                    },
                    rangeSeparator: " ถึง ", // ใช้เมื่อเลือกช่วงวันที่
                    weekAbbreviation: "สัปดาห์",
                    scrollTitle: "เลื่อนเพื่อเลือก",
                    toggleTitle: "คลิกเพื่อเปลี่ยน",
                    nextArrow: "ถัดไป",
                    prevArrow: "ก่อนหน้า",
                }
            });
        
            // จำกัดการป้อนข้อมูลเบอร์โทรให้มีแต่ตัวเลข
            const phoneInputs = document.querySelectorAll('input[type="tel"]');
            phoneInputs.forEach(input => {
                input.addEventListener('input', function() {
                    this.value = this.value.replace(/[^0-9]/g, ''); // ลบตัวอักษรที่ไม่ใช่ตัวเลขออก
                });
            });
        
            // จำกัดการป้อนตัวเลขในชื่อและนามสกุล
            const nameFields = document.querySelectorAll('input[name="DadFirstname"], input[name="DadLastname"], input[name="MomFirstname"], input[name="MomLastname"], input[name="KidFirstname"], input[name="KidLastname"]');
            nameFields.forEach(field => {
                restrictNonLetters(field);
            });
        });
        