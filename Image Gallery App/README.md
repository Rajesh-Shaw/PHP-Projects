📸 Image Gallery App
A clean and simple PHP + MySQL Image Gallery that allows users to upload images, preview them before upload, store them in a database, and display them in a responsive gallery layout. Includes drag-and-drop upload, multi-file support, and delete functionality.
________________________________________
🚀 Features
✅ Core Features
•	Upload multiple images
•	Store title + image path in MySQL
•	Responsive gallery grid
•	Delete images from database + folder
⭐ Advanced Features
•	Drag & drop upload area
•	Live preview before uploading
•	Auto-generated unique filenames
•	Clean UI with CSS
________________________________________
📁 Project Structure
Image-Gallery/
│
├── db.php
├── index.php
├── upload.php
├── delete.php
├── style.css
├── script.js
└── uploads/          # Images stored here
________________________________________
🛠 Installation Guide
1. Download or Clone the Project
Place inside your server directory (WAMP/XAMPP):
htdocs/Image-Gallery/
________________________________________
2. Create the Database
Run the following SQL:
``` bash
CREATE DATABASE image_gallery_db;

USE image_gallery_db;

CREATE TABLE images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    file_path VARCHAR(255),
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
________________________________________
3. Configure Database Connection
Open db.php and edit:
``` bash
$conn = new mysqli("localhost", "root", "", "image_gallery_db");
```
________________________________________
4. Start the Application
Visit:
http://localhost/Image-Gallery/
________________________________________
🔧 How It Works
Image Upload Flow
1.	User enters title (optional)
2.	Drag/Drop or browse images
3.	Preview shows selected files
4.	Click Upload
5.	Images saved in /uploads/ folder
6.	File record stored in database
Delete Flow
•	Clicking delete removes:
o	The file from server
o	The row from database

________________________________________
🧑‍💻 Tech Stack
•	PHP (Core Logic)
•	MySQL (Database)
•	HTML / CSS (UI)
•	JavaScript (Preview + Drag & Drop)
________________________________________
🔮 Future Enhancements
•	Search images by title
•	Image categories
•	Pagination
•	User login system
•	Bulk delete
•	Dark/Light mode

________________________________________
👨‍💻 Author
   Developed by: Rajesh Shaw
   Project Type: PHP CRUD System
   GitHub : https://github.com/Rajesh-Shaw/
   Linkdin: https://www.linkedin.com/in/rajeshshaw52/
