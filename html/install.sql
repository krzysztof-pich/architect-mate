CREATE TABLE repository (
    `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` varchar(255) NOT NULL,
    `destination` varchar(255) NOT NULL,
    `description` TEXT,
    `type` int
) ENGINE=InnoDB CHARSET=utf8 COLLATE utf8_general_ci;
