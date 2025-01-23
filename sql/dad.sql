CREATE TABLE dad (
    dad_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    DadFirstname VARCHAR(50) NOT NULL,
    DadLastname VARCHAR(50) NOT NULL,
    DadAge INT NOT NULL,
    DadTel VARCHAR(20),
    MomFirstname VARCHAR(50) NOT NULL,
    MomLastname VARCHAR(50) NOT NULL,
    MomAge INT NOT NULL,
    MomTel VARCHAR(20),
    user_id INT(11) NOT NULL,
    parent_id INT(11) NOT NULL,
    CONSTRAINT fk_user_id_dad FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE,
    CONSTRAINT fk_parent_id_dad FOREIGN KEY (parent_id) REFERENCES parent(parent_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
