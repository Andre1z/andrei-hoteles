CREATE DATABASE IF NOT EXISTS room_gestion;

USE room_gestion;

CREATE TABLE IF NOT EXISTS rooms (
    room_id INT AUTO_INCREMENT PRIMARY KEY,
    room_number VARCHAR(100) NOT NULL,
    room_type VARCHAR(100) NOT NULL,
    availability BOOLEAN DEFAULT TRUE,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);