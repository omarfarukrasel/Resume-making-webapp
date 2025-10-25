-- Create database if not exists
CREATE DATABASE IF NOT EXISTS resumewebapp;
USE resumewebapp;

-- Create branch table
CREATE TABLE IF NOT EXISTS branch (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- Create college table
CREATE TABLE IF NOT EXISTS college (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- Create users table for future authentication
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create resumes table for saving functionality
CREATE TABLE IF NOT EXISTS resumes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    mobile VARCHAR(20),
    gender ENUM('Male', 'Female', 'Other'),
    
    -- School Details
    ssc_school VARCHAR(255),
    ssc_board VARCHAR(100),
    ssc_year VARCHAR(10),
    ssc_percent DECIMAL(5,2),
    
    -- Higher Secondary Details
    hsc_college VARCHAR(255),
    hsc_board VARCHAR(100),
    hsc_year VARCHAR(10),
    hsc_percent DECIMAL(5,2),
    
    -- BSc Details
    bsc_university VARCHAR(255),
    bsc_college VARCHAR(255),
    bsc_start_date DATE,
    bsc_end_date DATE,
    bsc_sem1 DECIMAL(4,2),
    bsc_sem2 DECIMAL(4,2),
    bsc_sem3 DECIMAL(4,2),
    bsc_sem4 DECIMAL(4,2),
    bsc_sem5 DECIMAL(4,2),
    bsc_sem6 DECIMAL(4,2),
    bsc_cgpa DECIMAL(4,2),
    
    -- MSc Details (Optional)
    has_msc BOOLEAN DEFAULT FALSE,
    msc_university VARCHAR(255),
    msc_college VARCHAR(255),
    msc_start_date DATE,
    msc_end_date DATE,
    msc_sem1 DECIMAL(4,2),
    msc_sem2 DECIMAL(4,2),
    msc_sem3 DECIMAL(4,2),
    msc_sem4 DECIMAL(4,2),
    msc_cgpa DECIMAL(4,2),
    
    objective TEXT,
    resume_data JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Insert sample data for testing
INSERT INTO branch (name) VALUES 
('Computer Science'),
('Information Technology'),
('Electronics'),
('Mechanical'),
('Civil');

INSERT INTO college (name) VALUES 
('Engineering College 1'),
('Engineering College 2'),
('Technical Institute 1'),
('Technical Institute 2'),
('University Department of Technology');