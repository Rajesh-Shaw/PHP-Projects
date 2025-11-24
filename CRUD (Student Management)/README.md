# 📘 PHP CRUD Project – Student Management System

A simple and modern **CRUD (Create, Read, Update, Delete) web application** built using **PHP and MySQL** to manage student records efficiently. This project is perfect for beginners learning PHP database operations.

---

## 🚀 Features

* ✅ Add new students
* 📄 View student list
* ✏️ Edit student details
* ❌ Delete students
* 🎨 Beautiful modern UI
* 📱 Responsive design
* 🔐 Secure database connection

---

## 🛠 Technologies Used

* PHP (Core PHP)
* MySQL
* HTML5
* CSS3
* Google Fonts (Poppins)
* XAMPP / WAMP / MAMP

---

## 📂 Project Structure

```
crud/
│
├── db.php
├── index.php
├── add.php
├── edit.php
├── delete.php
├── style.css
└── README.md
```

---

## 🗄 Database Setup

Create a database named:

```
crud_db
```

Run the following SQL query in phpMyAdmin:

```sql
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL
);
```

---

## 🔌 Database Configuration (db.php)

```php
<?php
$conn = mysqli_connect("localhost", "root", "", "crud_db");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
```

---

## ▶ How to Run the Project

1. Install WAMP or XAMPP or any PHP server
2. Place the project folder inside:

```
www/crud
    or
htdocs/crud
```

3. Start Apache & MySQL
4. Open phpMyAdmin and create database
5. Import the SQL table
6. Open browser and visit:

```
http://localhost/crud/index.php
```

---

## 🖥 Screens Included

* Student List Page
* Add Student Page
* Edit Student Page
* Delete Confirmation

---

## 📸 UI Highlights

* Gradient background
* Card design layout
* Animated buttons
* Clean typography
* Hover effects

---

## 🔒 Security Suggestions (Optional Enhancements)

* Use prepared statements (PDO)
* Validate form inputs
* Add authentication system
* Add CSRF protection

---

## 📈 Future Improvements

* 🔍 Search functionality
* 📄 Pagination
* 👤 User login system
* 📊 Admin dashboard
* 🌙 Dark mode

---

## 👨‍💻 Author

Developed by: Rajesh Shaw
Project Type: PHP CRUD System
GitHub : https://github.com/Rajesh-Shaw/
Linkdin: https://www.linkedin.com/in/rajeshshaw52/

---

## 📄 License

This project is open-source and free to use for learning and educational purposes.

---

### ⭐ If you found this helpful, consider enhancing it further or sharing it with other learners!