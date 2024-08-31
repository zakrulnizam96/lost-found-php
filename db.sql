-- Create the database
CREATE DATABASE lost_and_found;

-- Use the created database
USE lost_and_found;

-- Create the table
CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    location VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    image VARCHAR(255), -- to store the image file name
    status ENUM('lost', 'found') NOT NULL,
    contact_info VARCHAR(255)
);
