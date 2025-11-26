# 📝 To-Do App with User Authentication (PHP + MySQL)

A modern and fully functional **To-Do List Web Application** built using PHP and MySQL with a clean & beautiful UI. This project supports user authentication and complete task management.

---

## 🚀 Features

### ✅ Basic

* User Registration & Login
* Add Tasks
* View Tasks
* Mark as Completed
* Delete Tasks (with confirmation popup)

### 🌟 Advanced

* Due Date for Tasks
* Edit Task Functionality
* Task Status (Pending / Completed)
* Secure Password Hashing
* Responsive UI

---

## 📂 Project Structure

```
Todo-App/
│
├── auth/
│   ├── login.php
│   ├── register.php
│   └── logout.php
│
├── db.php
├── index.php
├── add.php
├── update.php
├── delete.php
├── edit.php
├── style.css
└── todo.sql
```

---

## 🗄 Database Setup

1. Open phpMyAdmin
2. Create new database: `todo_db`
3. Import `todo.sql`

### Tables:

* `users` → user authentication
* `tasks` → user tasks

---

## ⚙ Installation Steps

1. Download or clone this repository
2. Move folder to:

```
C:/wamp64/www/
```

3. Import database using phpMyAdmin
4. Start WAMP Server
5. Open in browser:

```
http://localhost/Todo-App/auth/register.php
```

---

## 🔐 Default Flow

1. Register a new user
2. Login with credentials
3. Add tasks
4. Manage your daily activities

---

## 🖼 UI Preview

✔ Clean cards
✔ Gradient background
✔ Responsive layout
✔ Confirmation dialogs

---

## 🛡 Security

* Passwords encrypted using `password_hash()`
* SQL injection prevention recommended via prepared statements (future upgrade)

---

## 📌 Future Enhancements

* Drag & Drop Tasks
* Task Priority Levels
* Dark Mode
* Admin Panel
* Progress Graphs

---

## 👨‍💻 Developer

**Rajesh Shaw**
GitHub: [https://github.com/Rajesh-Shaw/](https://github.com/Rajesh-Shaw/)
Linkdin: https://www.linkedin.com/in/rajeshshaw52/

---

## ✅ License

This project is open-source and free to use for learning and personal projects.

---

⭐ If you found this project helpful, please star the repository!
