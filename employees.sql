CREATE DATABASE employee_db;

USE employee_db;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

-- Insert a sample user (password: secure123)
INSERT INTO users (username, password)
VALUES ('employee1', MD5('secure123'));
