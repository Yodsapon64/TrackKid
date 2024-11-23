CREATE TABLE `dad` (
    `dad_id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `DadFirstname` VARCHAR(50),
    `DadLastname` VARCHAR(50),
    `DadAge` INT,
    `DadTel` VARCHAR(20),
    `MomFirstname` VARCHAR(50),
    `MomLastname` VARCHAR(50),
    `MomAge` INT,
    `MomTel` VARCHAR(20),
    `user_id` INT(11),
    `parent_id` INT(11),
    CONSTRAINT fk_user_id_dad FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`) ON DELETE CASCADE,
    CONSTRAINT fk_parent_id_dad FOREIGN KEY (`parent_id`) REFERENCES `parent`(`parent_id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
