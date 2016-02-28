CREATE TABLE users
(
	user_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	last_name varchar(255) NOT NULL,
	first_name varchar(255) NOT NULL,
	email varchar(255) NOT NULL UNIQUE,
	password varchar(255) NOT NULL,
	balance float(10, 2) NOT NULL
)
