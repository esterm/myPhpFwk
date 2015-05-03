CREATE DATABASE IF NOT EXISTS `my_fwk_db`;

USE my_fwk_db;

#The next line will create the user if it does not exist, and will give their all privileges
grant all on `my_fwk_db`.* to 'myFwkUser'@'localhost' identified by 'myfwkMolon';

CREATE TABLE IF NOT EXISTS `users`
(
	id INT(10) PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL
);