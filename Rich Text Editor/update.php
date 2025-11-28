<?php
include 'db.php';

$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];

mysqli_query($conn, "UPDATE posts SET title='$title', content='$content' WHERE id=$id");
header("Location: view.php?id=$id");
?>
