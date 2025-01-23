CREATE TABLE `doc` (
    `doc_id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `doc_username` VARCHAR(50) NOT NULL,
    `doc_email` VARCHAR(255) NOT NULL UNIQUE,
    `doc_password` VARCHAR(255) NOT NULL,
    `doc_fullname` VARCHAR(255) NOT NULL,
    `doc_department` VARCHAR(100) NOT NULL,
    `doc_phone` VARCHAR(20),
    `doc_created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
