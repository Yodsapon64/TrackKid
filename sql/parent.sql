CREATE TABLE `parent` (
    `parent_id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `ParentFirstname` VARCHAR(50),
    `ParentLastname` VARCHAR(50),
    `ParentStatus` VARCHAR(50), -- เช่น "Father", "Mother", หรือ "Guardian"
    `ParentAge` INT,
    `ParentTel` VARCHAR(20),
    `user_id` INT(11),
    CONSTRAINT fk_user_id_parent FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
