##  🔗 URL Shortener
A simple and efficient PHP + MySQL URL Shortener that converts long URLs into short links and tracks click statistics.
________________________________________
##  ✨ Features
•	Shorten any long URL
•	Auto-generated short codes
•	Redirect to original URL
•	Click counter
•	List of all short URLs
•	Clean and responsive UI
________________________________________
##  🛠️ Tech Stack
•	PHP
•	MySQL
•	HTML/CSS
•	JavaScript
________________________________________
##  📂 Project Structure
/url-shortener/
│── index.php          # Main page (shorten form + list)
│── redirect.php       # Handles URL redirects
│── db.php             # Database connection
│── style.css          # UI styling
│── README.md
________________________________________
## 🗄️ Database Setup
Create database:
CREATE DATABASE url_shortener;
Create table:
CREATE TABLE links (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(20) UNIQUE NOT NULL,
    long_url TEXT NOT NULL,
    clicks INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
________________________________________
## ⚙️ Configuration
Update db.php:
$host = "localhost";
$user = "root";
$pass = "";
$db   = "url_shortener";
________________________________________
## 🚀 How to Use
1.	Enter any long URL into the input box
2.	Click Shorten URL
3.	Copy the short link
4.	When someone opens it → they get redirected & click count increases
________________________________________
##  🔧 Future Enhancements
•	Custom short codes
•	QR code generation
•	User accounts
•	API support
•	Analytics dashboard

________________________________________
## 👨‍💻 Author
   Developed by: Rajesh Shaw
   Project Type: PHP CRUD System
   GitHub : https://github.com/Rajesh-Shaw/
   Linkdin: https://www.linkedin.com/in/rajeshshaw52/