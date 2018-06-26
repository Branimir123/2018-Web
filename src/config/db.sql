CREATE DATABASE IF NOT EXISTS `quotes-db` COLLATE utf8mb4_unicode_ci;
USE `quotes-db`;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50),
  email VARCHAR(50),
  full_name VARCHAR(50),
  password VARCHAR(128)
);

CREATE TABLE quote (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(128),
  start_date DATE,
  author_id INT NOT NULL,
  quote_text TEXT(128),
  FOREIGN KEY (author_id) REFERENCES users(id)
);

CREATE TABLE opinions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  opinion_date DATE,
  user_id INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id)
);
