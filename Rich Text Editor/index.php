<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Posts</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
<h2>All Posts</h2>
<a href="add.php" class="btn">+ New Post</a>

<?php
$result = mysqli_query($conn, "SELECT * FROM posts ORDER BY id DESC");
while($row = mysqli_fetch_assoc($result)):
?>
<div class="post-card">
    <h3><?= $row['title'] ?></h3>
    <a href="view.php?id=<?= $row['id'] ?>">Read More</a>
</div>
<?php endwhile; ?>
</div>

</body>
</html>
