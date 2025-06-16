CREATE DATABASE IF NOT EXISTS buspassdb;
USE buspassdb;
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(15),
    address TEXT
);
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL
);
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);
CREATE TABLE IF NOT EXISTS passes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    route VARCHAR(100) NOT NULL,
    duration VARCHAR(50) NOT NULL,
    cost DECIMAL(10,2) NOT NULL,
    apply_date DATE NOT NULL DEFAULT CURRENT_DATE,
    start_date DATE NOT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'Pending',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert initial data
INSERT INTO admin (username, password) 
VALUES ('admin', MD5('admin1239'));

INSERT INTO users (name, email, password, phone, address) VALUES
('Nayandhana', 'nayandhanagangadharan@gmail.com', MD5('nayan123'), '9876543210', 'Thingalur, Perundurai'),
('Dharshini', 'dharshinithangaraj@gmail.com', MD5('dharsh123'), '9123456789', 'Gandhipuram, Coimbatore');

INSERT INTO passes (user_id, route, duration, cost, apply_date, start_date, status) VALUES
(1, 'Thingalur to Erode', '1 Month', 500.00, CURDATE(), '2025-06-17', 'Pending'),
(2, 'Erode to Coimbatore', '3 Months', 1200.00, CURDATE(), '2025-06-23', 'Pending'); 
