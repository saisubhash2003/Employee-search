CREATE DATABASE IF NOT EXISTS employee_db;
USE employee_db;

CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id VARCHAR(10) UNIQUE,
    first_name VARCHAR(50),
    middle_name VARCHAR(50),
    last_name VARCHAR(50),
    login_id VARCHAR(20) UNIQUE,
    dob DATE,
    department VARCHAR(20),
    salary DECIMAL(10,2),
    permanent_address TEXT,
    current_address TEXT,
    id_proof_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
