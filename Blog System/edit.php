<?php
session_start();
require 'db.php';
if(!isset($_SESSION['user_id'])) header('Location: auth/login.php');

$id = (int)($_GET['id'] ?? 0);
$stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->bind_param('i',$id);
$stmt->execute();
$post = $stmt->get_result()->fetch_assoc();
$stmt->close();
if(!$post) { echo 'Post not found'; exit; }
if($post['user_id'] != $_SESSION['user_id']) { echo 'Not allowed'; exit; }

$errors = '';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $image_name = $post['image'];

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
        $upd = $conn->prepare("UPDATE posts SET title=?, content=?, image=? WHERE id=?");
        $upd->bind_param('sssi', $title, $content, $image_name, $id);
        if($upd->execute()){
            header('Location: view.php?slug=' . urlencode($post['slug']));
            exit;
        } else $errors = 'Update failed.';
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Edit Post</title><link rel="stylesheet" href="style.css"></head>
<body>
<div class="box">
  <h2>Edit Post</h2>
  <?php if($errors): ?><p class="error"><?=htmlspecialchars($errors)?></p><?php endif; ?>
  <form method="post" enctype="multipart/form-data">
    <input type="text" name="title" value="<?=htmlspecialchars($post['title'])?>" required>
    <?php if($post['image']): ?>
      <p>Current image:<br><img src="uploads/<?=htmlspecialchars($post['image'])?>" style="max-width:150px"></p>
    <?php endif; ?>
    <input type="file" name="image" accept="image/*">
    <textarea name="content" required><?=htmlspecialchars($post['content'])?></textarea>
    <button>Update</button>
  </form>
  <p><a href="index.php">← Back</a></p>
</div>
</body>
</html>
