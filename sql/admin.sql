CREATE TABLE `admin` (
    `admin_id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `admin_username` VARCHAR(50) NOT NULL UNIQUE,
    `admin_email` VARCHAR(255) NOT NULL UNIQUE,
    `admin_password` VARCHAR(255) NOT NULL,
    `admin_fullname` VARCHAR(255) NOT NULL,
    `admin_created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
