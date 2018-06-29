CREATE DATABASE IF NOT EXISTS `quotesDb` COLLATE utf8mb4_unicode_ci;
USE `quotesDb`;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50),
  email VARCHAR(50),
  full_name VARCHAR(50),
  password VARCHAR(128)
);

CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  category_name VARCHAR(128)
);

CREATE TABLE quotes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(128),
  date_added DATETIME,
  author_id INT NOT NULL,
  category_id INT NOT NULL,
  quote_text TEXT(128),
  FOREIGN KEY (category_id) REFERENCES categories(id),
  FOREIGN KEY (author_id) REFERENCES users(id)
);

CREATE TABLE opinions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  opinion_date DATE,
  user_id INT NOT NULL,
  quote_id INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (quote_id) REFERENCES quotes(id)
);

INSERT INTO categories (category_name) VALUES ("friendship");
INSERT INTO categories (category_name) VALUES ("fun");
INSERT INTO categories (category_name) VALUES ("love");
INSERT INTO categories (category_name) VALUES ("life");
INSERT INTO categories (category_name) VALUES ("death");