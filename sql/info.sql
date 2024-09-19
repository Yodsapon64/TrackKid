CREATE TABLE info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    DadFirstname VARCHAR(50),
    DadLastname VARCHAR(50),
    DadAge INT,
    DadTel VARCHAR(20),
    
    MomFirstname VARCHAR(50),
    MomLastname VARCHAR(50),
    MomAge INT,
    MomTel VARCHAR(20),
    
    ParentFirstname VARCHAR(50),
    ParentLastname VARCHAR(50),
    ParentStatus VARCHAR(20),
    ParentAge INT,
    ParentEmail VARCHAR(100),
    ParentTel VARCHAR(20),
    
    KidFirstname VARCHAR(50),
    KidLastname VARCHAR(50),
    KidBirth DATE,
    KidGender ENUM('Male', 'Female'),
    Address TEXT,
    BloodType ENUM('A', 'B', 'AB', 'O'),
    Weight DECIMAL(5,2),
    KidHeight DECIMAL(5,2),
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
