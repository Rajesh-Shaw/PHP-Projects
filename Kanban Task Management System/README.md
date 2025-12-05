# 🗂️ FlowTrack – Kanban Task Management System

FlowTrack is a modern, clean, and powerful **Kanban-style task manager** built with **PHP, MySQL, HTML, CSS, and JavaScript**.  
It allows users to manage tasks visually with an interactive drag-and-drop interface.

---

## 🚀 Features

### 🔐 User System
- Register account  
- Login / Logout  
- Session authentication  
- Profile photo upload (optional)

---

### 📝 Task Management
- Add tasks  
- Edit tasks  
- Delete tasks  
- Mark tasks as complete  
- Task details modal (optional)

---

### 📌 Kanban Board
Three main workflow columns:
- **To Do**
- **In Progress**
- **Done**

Includes:
- Drag & drop between columns  
- Auto-save task status  
- Smooth animations  

---

### 🛠️ Backend
- PHP-based API for all CRUD operations  
- MySQL database  
- Secure password hashing  
- Proper session handling  

---

## 🗄️ Database Structure

### **users**
| Column     | Type        | Description |
|------------|-------------|-------------|
| id         | INT (PK)    | User ID |
| name       | VARCHAR     | Full name |
| email      | VARCHAR     | Email address |
| password   | VARCHAR     | Hashed password |
| photo      | VARCHAR     | Profile image (optional) |
| created_at | TIMESTAMP   | Timestamp |

---

### **tasks**
| Column      | Type                         | Description |
|-------------|------------------------------|-------------|
| id          | INT (PK)                     | Task ID |
| user_id     | INT (FK → users.id)          | Owner |
| title       | VARCHAR                      | Task title |
| description | TEXT                         | Task details |
| status      | ENUM('todo','progress','done') | Kanban column |
| priority    | ENUM('low','medium','high')  | Task importance (optional) |
| due_date    | DATE                         | Deadline (optional) |
| color       | VARCHAR                      | Task label color (optional) |
| file        | VARCHAR                      | Attachment (optional) |
| created_at  | TIMESTAMP                    | Timestamp |

---

## 🔥 Optional Advanced Features
- Due dates  
- Priority flags  
- Color tags  
- Attachments  
- Dark/Light mode  
- Search box  
- Subtasks  
- Activity logs (“Task moved to Done”)  
- Multi-user collaborative boards  

---

## 📦 Installation

### 1️⃣ Download or Clone
```bash
 git clone https://github.com/Rajesh-Shaw/PHP-Projects.git
```

### 2️⃣ Move to server directory (XAMPP/WAMP)
 ```bash
    htdocs/Kanban%20Task%20Management%20System/
```
### 3️⃣ Import the Database
```bash
Import database.sql into phpMyAdmin.
    ```
### 4️⃣ Configure Database
```bash
    Edit db.php:
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "kanban";
```
$conn = new mysqli($host, $user, $pass, $db);

### 5️⃣ Run Project
```bash
Visit in browser:
http://localhost/Kanban%20Task%20Management%20System/
```
---

## 👨‍💻 Author
   Developed by: Rajesh Shaw
   Project Type: PHP CRUD System
   GitHub : https://github.com/Rajesh-Shaw/
   Linkdin: https://www.linkedin.com/in/rajeshshaw52/