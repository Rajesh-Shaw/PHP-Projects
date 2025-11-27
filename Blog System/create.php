<?php
session_start();
require 'db.php';
if(!isset($_SESSION['user_id'])) header('Location: auth/login.php');

$errors = '';
if(isset($_POST['create'])){
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $slug = strtolower(preg_replace('/[^A-Za-z0-9-]+/','-', $title));
    $user_id = $_SESSION['user_id'];
    $image_name = null;

    // handle image upload
    if(isset($_FILES['image']) && $_FILES['image']['error']===0){
        $allowed = ['jpg','jpeg','png','gif'];
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if(!in_array($ext, $allowed)){
            $errors = 'Invalid image type.';
        } else {
            $image_name = time().'-'.bin2hex(random_bytes(4)).'.'.$ext;
            move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/'.$image_name);
        }
    }

    if(!$errors){
        // ensure unique slug
        $baseSlug = $slug;
        $i = 1;
        while(true){
            $stmt = $conn->prepare("SELECT id FROM posts WHERE slug = ?");
            $stmt->bind_param('s',$slug);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows>0){
                $slug = $baseSlug.'-'.$i; $i++;
                $stmt->close();
            } else {
                $stmt->close();
                break;
            }
        }

        $ins = $conn->prepare("INSERT INTO posts (user_id,title,slug,content,image) VALUES (?,?,?,?,?)");
        $ins->bind_param('issss', $user_id, $title, $slug, $content, $image_name);
        if($ins->execute()){
            header('Location: view.php?slug=' . urlencode($slug));
            exit;
        } else {
            $errors = 'Failed to create post.';
        }
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8"><title>Create Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="box">
  <h2>Create Post</h2>
  <?php if($errors): ?><p class="error"><?=htmlspecialchars($errors)?></p><?php endif; ?>
  <form method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Title" required>
    <input type="file" name="image" accept="image/*">
    <textarea name="content" placeholder="Write your post..." required></textarea>
    <button name="create">Publish</button>
  </form>
  <p><a href="index.php">← Back</a></p>
</div>
</body>
</html>
