<?php
require 'db.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $name = trim($_POST['name']);
    if($name !== ''){
        $stmt = $conn->prepare("INSERT INTO playlists (name) VALUES (?)");
        $stmt->bind_param('s', $name);
        $stmt->execute();
        header('Location: index.php');
        exit;
    }
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Create Playlist</title><link rel="stylesheet" href="style.css"></head>
<body>
<div class="container small">
  <h2>Create Playlist</h2>
  <form method="post">
    <input type="text" name="name" placeholder="Playlist name" required>
    <button class="btn">Create</button>
    <a href="index.php" class="btn subtle">Back</a>
  </form>
</div>
</body>
</html>
