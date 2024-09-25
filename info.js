document.addEventListener("DOMContentLoaded", function() {
    // ตั้งค่า Flatpickr สำหรับ input วันเกิด
    flatpickr("#kidBirth", {
        dateFormat: "Y-m-d",  // รูปแบบวันที่เป็นปี-เดือน-วัน
        maxDate: "today",  // เลือกได้ถึงวันที่ปัจจุบัน
        minDate: new Date().setFullYear(new Date().getFullYear() - 12), // ย้อนหลังได้สูงสุด 12 ปี
        locale: {
            firstDayOfWeek: 1, // เริ่มต้นสัปดาห์ที่วันจันทร์
            weekdays: {
                shorthand: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"],
                longhand: ["อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์"]
            },
            months: {
                shorthand: ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."],
                longhand: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"]
            },
            rangeSeparator: " ถึง ",
            weekAbbreviation: "สัปดาห์",
            scrollTitle: "เลื่อนเพื่อเลือก",
            toggleTitle: "คลิกเพื่อเปลี่ยน",
            nextArrow: "ถัดไป",
            prevArrow: "ก่อนหน้า",
            time_24hr: true, // ใช้ระบบเวลา 24 ชั่วโมง
        },
        onReady: function(selectedDates, dateStr, instance) {
            // เปลี่ยนปีให้เป็น พ.ศ. เมื่อเปิดปฏิทิน
            convertYearToBuddhist(instance);
        },
        onChange: function(selectedDates, dateStr, instance) {
            // เปลี่ยนปีให้เป็น พ.ศ. เมื่อเลือกวันที่ใหม่
            convertYearToBuddhist(instance);
        },
        onMonthChange: function(selectedDates, dateStr, instance) {
            // เปลี่ยนปีให้เป็น พ.ศ. เมื่อเปลี่ยนเดือน
            convertYearToBuddhist(instance);
        },
        onClose: function(selectedDates, dateStr, instance) {
            // แปลงวันที่เลือกเป็นปี พ.ศ. ใน input
            if (selectedDates.length > 0) {
                const selectedDate = selectedDates[0];
                const buddhistYear = selectedDate.getFullYear() + 543;
                const month = ("0" + (selectedDate.getMonth() + 1)).slice(-2); // เติมเลข 0 หน้าถ้าจำนวนหลักเป็นตัวเดียว
                const day = ("0" + selectedDate.getDate()).slice(-2); // เติมเลข 0 หน้าถ้าจำนวนหลักเป็นตัวเดียว
                document.getElementById("kidBirth").value = `${buddhistYear}-${month}-${day}`;
            }
        },
        parseDate: function(dateStr, format) {
            // แปลงวันที่จาก พ.ศ. เป็น ค.ศ. ก่อนส่งไปยัง Flatpickr
            const parts = dateStr.split("-");
            const buddhistYear = parseInt(parts[0]) - 543; // แปลงปี พ.ศ. เป็น ค.ศ.
            return new Date(buddhistYear, parts[1] - 1, parts[2]); // ค.ศ., เดือน, วัน
        }
    });

    function convertYearToBuddhist(instance) {
        // เปลี่ยนปีจาก ค.ศ. เป็น พ.ศ. ในปฏิทิน Flatpickr
        const calendarYearElements = instance.calendarContainer.querySelectorAll(".flatpickr-current-year");
        calendarYearElements.forEach(function(yearElem) {
            const year = parseInt(yearElem.value);
            if (year < 2500) {
                yearElem.value = (year + 543).toString(); // เปลี่ยนเป็น พ.ศ.
            }
        });
    }

    // เพิ่มการตรวจสอบสำหรับเบอร์โทร
    const telInputs = document.querySelectorAll('input[type="tel"]');
    telInputs.forEach(function(input) {
        input.addEventListener("input", function() {
            this.value = this.value.replace(/[^0-9]/g, ''); // อนุญาตให้กรอกได้เฉพาะตัวเลข
        });
    });

    // เพิ่มการตรวจสอบไม่ให้ชื่อและนามสกุลมีตัวเลข
    const textInputs = document.querySelectorAll('input[type="text"]');
    textInputs.forEach(function(input) {
        input.addEventListener("input", function() {
            this.value = this.value.replace(/[\d]/g, ''); // อนุญาตให้กรอกได้เฉพาะตัวอักษร
        });
    });

    // ตรวจสอบให้เบอร์โทรบิดาและมารดาไม่ให้ใส่ซ้ำกัน
    const dadTelInput = document.querySelector('input[name="DadTel"]');
    const momTelInput = document.querySelector('input[name="MomTel"]');

    dadTelInput.addEventListener("input", checkTelDuplicate);
    momTelInput.addEventListener("input", checkTelDuplicate);

    function checkTelDuplicate() {
        if (dadTelInput.value === momTelInput.value) {
            alert("เบอร์โทรบิดาและมารดาไม่สามารถใส่เหมือนกันได้");
            dadTelInput.value = "";
            momTelInput.value = "";
        }
    }

    // ตรวจสอบน้ำหนักและส่วนสูงให้ใส่ได้เฉพาะตัวเลข
    const numberInputs = document.querySelectorAll('input[type="number"]');
    numberInputs.forEach(function(input) {
        input.addEventListener("input", function() {
            this.value = this.value.replace(/[^0-9.]/g, ''); // อนุญาตให้กรอกได้เฉพาะตัวเลขและจุด
        });
    });
});