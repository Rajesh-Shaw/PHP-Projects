<?php
$conn = new mysqli("localhost", "root", "", "notes_app_db");

if ($conn->connect_error) {
    die("DB Connection Failed: " . $conn->connect_error);
}
?>
