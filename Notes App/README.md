# 📒 Notes App — PHP + MySQL + AJAX

A simple and clean **Notes Management Web App** built using **PHP, MySQL, AJAX, and Vanilla JavaScript**.

This app allows users to create, update, delete, search, and filter notes with a beautiful UI.

---

## 🚀 Features

### ✅ Core Features
- Add Notes (title + description + tag)
- Edit Notes
- Delete Notes
- View all notes
- Timestamp for each note

### 🔍 Advanced Features
- AJAX Live Search  
- Tag-based filtering  
- Responsive UI  
- Light/Dark Mode Toggle  

---

## 📁 Project Structure

notes-app/
│
├── db.php
├── index.php
├── add.php
├── edit.php
├── delete.php
├── search.php
├── style.css
│
└── sql/
└── notes.sql


---

## 🛠 Database Setup

1. Create a database:

notes_app

2. Import the SQL file:

```sql
CREATE TABLE notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    tag VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

3. Update your database connection in db.php :

```bash
$conn = new mysqli("localhost", "root", "", "notes_app");
```

---

##  📌 How to Run
1️⃣ Move Directory to Server Root

For XAMPP:
htdocs/notes-app/


For WAMP:
www/notes-app/

2️⃣ Start Apache & MySQL
3️⃣ Run the App
http://localhost/notes-app/

## 📌 Future Enhancements (Optional)

User Authentication

Categories/Tags management

File attachments

Pin important notes

Export notes to PDF

## 👨‍💻 Author

Developed by: Rajesh Shaw
📌 PHP + MySQL Projects