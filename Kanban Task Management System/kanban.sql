CREATE DATABASE kanban_app_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE kanban_app_db;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  fullname VARCHAR(150) NOT NULL,
  email VARCHAR(200) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  avatar VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  status ENUM('todo','inprogress','done') NOT NULL DEFAULT 'todo',
  priority ENUM('low','medium','high') DEFAULT 'medium',
  due_date DATE DEFAULT NULL,
  color VARCHAR(20) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
