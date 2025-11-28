<?php include 'db.php'; 
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM posts WHERE id=$id");
$post = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
<title><?= $post['title'] ?></title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
<h2><?= $post['title'] ?></h2>
<div class="content">
    <?= $post['content'] ?>
</div>

<a href="index.php" class="btn">⬅ Back to Home</a>
<a href="edit.php?id=<?= $id ?>" class="btn">✏ Edit</a>
<a href="delete.php?id=<?= $id ?>" onclick="return confirm('Delete this post?')" class="btn danger">❌ Delete</a>
</div>

</body>
</html>
