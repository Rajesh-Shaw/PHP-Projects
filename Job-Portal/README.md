# 🧑‍💼 Job Portal System (PHP + MySQL)

A complete Job Portal application built with **PHP**, **MySQL**, and **HTML/CSS**.  
This system allows **Admins** to post jobs and manage applicants, while **Users** can register, log in, browse jobs, and apply online.

---

## 🚀 Features

### 👨‍💼 Admin Panel
- Admin Login / Logout
- Add New Job
- Edit Job
- Delete Job
- Manage All Jobs
- View Job Applicants
- Clean Dashboard UI

### 👤 User Features
- Register / Login
- Browse All Jobs
- View Job Details
- Apply for a Job
- Upload Resume (PDF)
- Track Applied Jobs

### 🛠️ Technical Features
- PHP 7+ / 8 Compatible
- Prepared Statements (Secure)
- MySQL Database
- Beautiful UI
- Secure Authentication
- Responsive Layout

---

## 📁 Folder Structure

```
Job-Portal/
│
├── admin/
│ ├── login.php
│ ├── dashboard.php
│ ├── add-job.php
│ ├── edit-job.php
│ ├── delete-job.php
│ ├── applicants.php
│ └── logout.php
│
├── user/
│ ├── register.php
│ ├── login.php
│ ├── apply.php
│ └── applications.php
│
├── jobs/
│ └── view.php
│
├── uploads/
│ └── resumes/
│
├── db.php
├── index.php
├── style.css
└── jobportal.sql

```
---

## 🛠️ Installation Guide

### 1️⃣ Clone the Repository
```
git clone https://github.com/your-username/Job-Portal.git
```

### 2️⃣ Move Project to Your Server
Place it inside:

htdocs/ (XAMPP)
www/ (WAMP)

### 3️⃣ Create Database
1. Open **phpMyAdmin**  
2. Create a new database:
jobportal

3. Import `jobportal.sql`

---

## 🔑 Default Admin Login



Email: admin@example.com

Password: admin123


(You can modify inside `jobportal.sql`)

---

## ⚙️ Configuration

Open `db.php` and update your MySQL credentials:

```php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "job_portal_db";
```

---

### 📚 Technologies Used
   PHP
   MySQL
   HTML / CSS
   JavaScript
   Jquery
   AJAX
   (Optionally) Composer

---

## 👨‍💻 Author
   Developed by: Rajesh Shaw
   Project Type: PHP CRUD System
   GitHub : https://github.com/Rajesh-Shaw/
   Linkdin: https://www.linkedin.com/in/rajeshshaw52/
