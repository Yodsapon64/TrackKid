CREATE TABLE `parent` (
    `parent_id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `ParentFirstname` VARCHAR(50),
    `ParentLastname` VARCHAR(50),
    `ParentStatus` VARCHAR(50),
    `ParentAge` INT,
    `ParentTel` VARCHAR(20),
    `user_id` INT(11)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
