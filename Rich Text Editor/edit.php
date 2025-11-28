<?php
include 'db.php';
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM posts WHERE id=$id");
$post = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Post</title>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">

<form action="update.php" method="post">
    <input type="hidden" name="id" value="<?= $id ?>">
    <input type="text" name="title" value="<?= $post['title'] ?>" required>
    <textarea name="content" id="editor"><?= $post['content'] ?></textarea>
    <button type="submit">Update</button>
</form>

</div>
<script>CKEDITOR.replace('editor');</script>
</body>
</html>
