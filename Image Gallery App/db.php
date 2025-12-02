<?php
$conn = new mysqli("localhost", "root", "", "image_gallery_db");
if($conn->connect_error){
    die("DB Connection Failed: ".$conn->connect_error);
}
?>
