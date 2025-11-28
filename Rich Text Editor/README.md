# 📝 PHP Rich Text Editor Project (CKEditor + MySQL)

A simple and secure **Rich Text Editor system** built using **PHP, MySQL, and CKEditor**. This project allows users to create, edit, view, and delete formatted content like a mini blog or CMS system.

---

## 🚀 Features

✅ Add rich text content (bold, images, links, headings, etc.)
✅ Edit existing posts
✅ View formatted content
✅ Delete content
✅ Secure CKEditor 4.25.1 LTS integration
✅ Clean and responsive UI
✅ MySQL database storage

---

## 📂 Project Structure

```
text-editor-project/
│
├── index.php        # Display all posts
├── create.php       # Add new content
├── edit.php         # Edit content
├── view.php         # View full content
├── delete.php       # Delete content
├── db.php           # Database connection
├── style.css        # UI styling
└── database.sql     # Database file
```

---

## 🛠 Requirements

* XAMPP / WAMP / MAMP / Localhost
* PHP 7.4+
* MySQL
* Web Browser
* Internet connection (for CKEditor CDN)

---

## ⚙️ Installation Steps

### 1️⃣ Create Database

Open phpMyAdmin and run:

```sql
CREATE DATABASE rich_text_editor_db;
USE rich_text_editor_db;

CREATE TABLE posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  content TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

Or import `database.sql` file directly.

---

### 2️⃣ Configure Database

Edit `db.php`:

```php
<?php
$conn = new mysqli('localhost','root','','rich_text_editor_db');
if($conn->connect_error){
    die('Connection Failed');
}
?>
```

---

### 3️⃣ Run Project

Move project folder to:

```
htdocs/text-editor-project
```

Open browser:

```
http://localhost/text-editor-project/
```

---

## ✍ CKEditor Version Used

```html
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
```


---

## 🧪 Usage

* Click **Add New Post**
* Write content using rich editor
* Save post
* Edit or delete anytime
* View formatted output

---

## 🔐 Security Tips

* Escape output using `htmlspecialchars()`
* Validate input data
* Use prepared statements for queries

---

## 🌟 Future Enhancements

* User Login System
* Comment System
* Categories & Tags
* Image Upload Manager
* Pagination

---

## 👨‍💻 Developed By

Developed by: Rajesh Shaw
Project Type: PHP CRUD System
GitHub : https://github.com/Rajesh-Shaw/
Linkdin: https://www.linkedin.com/in/rajeshshaw52/

---

## 📞 Support

If you need help or upgrades:
✅ CKEditor 5
✅ TinyMCE
✅ Full CMS System
✅ Admin Panel

Just ask 😄
