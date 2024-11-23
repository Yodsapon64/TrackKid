CREATE TABLE `kid` (
    `kid_id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `KidFirstname` VARCHAR(50),
    `KidLastname` VARCHAR(50),
    `KidBirth` DATE,
    `KidAge` INT,
    `KidGender` VARCHAR(10),
    `Address` TEXT,
    `BloodType` VARCHAR(5),
    `Weight` FLOAT,
    `KidHeight` FLOAT,
    `UpdateDate` DATETIME,
    `user_id` INT(11),  
    `parent_id` INT(11), 
    CONSTRAINT fk_user_id_kid FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`),
    CONSTRAINT fk_parent_id_kid FOREIGN KEY (`parent_id`) REFERENCES `parent`(`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
