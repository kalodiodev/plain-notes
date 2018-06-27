CREATE SCHEMA `plain-notes`;

CREATE TABLE `plain-notes`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `admin` BOOLEAN DEFAULT FALSE,
  `confirmation` VARCHAR(255),
  `forgot_password` VARCHAR(255),
  `forgot_password_expires` VARCHAR(255),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE `plain-notes`.`notes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(65) NOT NULL,
  `description` VARCHAR(255) DEFAULT NULL,
  `exp_date` VARCHAR(45) DEFAULT NULL,
  `user_id` INT(11) NOT NULL,
  `created_on` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `details` TEXT,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `plain-notes`.`users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB CHARSET=utf8;