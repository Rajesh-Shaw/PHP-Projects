<?php
include 'db.php';

$id = $_GET['id'];

$q = $conn->query("SELECT file_path FROM images WHERE id=$id");
$data = $q->fetch_assoc();

if(file_exists($data['file_path'])){
    unlink($data['file_path']);
}

$conn->query("DELETE FROM images WHERE id=$id");

header("Location: index.php");
exit();
?>
