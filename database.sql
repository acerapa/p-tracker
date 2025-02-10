CREATE TABLE `users` ( 
	`id` INT NOT NULL AUTO_INCREMENT ,
    `first_name` VARCHAR(255) NULL ,
    `last_name` VARCHAR(255) NULL ,
    `username` VARCHAR(255) NOT NULL ,
    `password` VARCHAR(255) NOT NULL ,
    `email` VARCHAR(255) NOT NULL ,
    `user_role` ENUM('admin','app') NOT NULL ,
    `application_info_id` INT NULL ,
    `created_at` DATE NOT NULL ,
    `updated_at` DATE NOT NULL ,
    PRIMARY KEY (`id`), UNIQUE `username` (`username`));

Create TABLE cashflows (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	user_id INT,
	amount DOUBLE,
	`when` date,
	description VARCHAR(255),
	is_income TINYINT,
	FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
);

CREATE TABLE expense_types (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255),
	created_at datetime
);