CREATE DATABASE `test_database`;
USE `test_database`;
CREATE TABLE `notes`
(
    `id`    int(11)     NOT NULL AUTO_INCREMENT,
    `title` varchar(60) NOT NULL,
    `text`  text        NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

INSERT INTO `notes` (`title`, `text`)
VALUES ('Example note', 'This is an example note to see that we can fetch records from the database.'),
       ('Another note', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ac sem euismod, faucibus ante ut, imperdiet quam.');

# Make sure to edit this if you keep it.
# - Change the host wildcard (%) to something more restrictive
# - Change the password
CREATE USER 'testuser'@'%' IDENTIFIED BY 'password';
GRANT ALL ON `test_database`.* TO 'testuser'@'%';