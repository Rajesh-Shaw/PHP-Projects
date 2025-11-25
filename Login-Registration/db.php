<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "login_registration");
if (!$conn) 
{
    die("Connection failed: " . mysqli_connect_error());
}
?>