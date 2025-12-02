<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
<title>Image Gallery</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="top-bar">
    <h2>📸 Image Gallery</h2>
    <a href="upload.php" class="btn">Upload Image</a>
</div>

<form method="GET" class="search-box">
    <input type="text" name="search" placeholder="Search image..." value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>">
    <button class="btn">Search</button>
</form>

<div class="gallery">
<?php
$search = "";
if(isset($_GET['search'])){
    $search = "WHERE title LIKE '%".$_GET['search']."%'";
}

$q = $conn->query("SELECT * FROM images $search ORDER BY id DESC");

while($row = $q->fetch_assoc()){
?>
    <div class="img-card">
        <img src="<?= $row['file_path'] ?>" alt="<?= $row['title'] ?>">
        <p><?= $row['title'] ?></p>

        <a href="delete.php?id=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Delete this image?')">✖</a>
    </div>
<?php } ?>
</div>

</body>
</html>
