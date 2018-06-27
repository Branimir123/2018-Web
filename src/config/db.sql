CREATE DATABASE IF NOT EXISTS `quotesDb` COLLATE utf8mb4_unicode_ci;
USE `quotesDb`;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50),
  email VARCHAR(50),
  full_name VARCHAR(50),
  password VARCHAR(128)
);

CREATE TABLE quotes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(128),
  date_added DATE,
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
