CREATE TABLE `users` (
    `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `email` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL
) ENGINE=InnoDB CHARSET=utf8 COLLATE utf8_general_ci;

ALTER TABLE `users`
  ADD UNIQUE KEY `email` (`email`);

CREATE TABLE `repository` (
    `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT(6) UNSIGNED,
    `name` varchar(255) NOT NULL,
    `destination` varchar(255) NOT NULL,
    `description` TEXT,
    `type` int,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB CHARSET=utf8 COLLATE utf8_general_ci;


