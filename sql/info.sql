CREATE TABLE info (
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    DadFirstname VARCHAR(50),
    DadLastname VARCHAR(50),
    DadAge INT,
    DadTel VARCHAR(20),
    
    MomFirstname VARCHAR(50),
    MomLastname VARCHAR(50),
    MomAge INT,
    MomTel VARCHAR(20),
    
    KidFirstname VARCHAR(50),
    KidLastname VARCHAR(50),
    KidBirth DATE,
    KidAge int,
    KidGender VARCHAR(10),
    Address TEXT,
    BloodType VARCHAR(5),
    Weight FLOAT,
    KidHeight FLOAT,
    UpdateDate DATETIME -- ฟิลด์สำหรับบันทึกวันที่อัพเดทข้อมูล
);
