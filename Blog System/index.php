<?php
session_start();
require 'db.php';

// fetch posts
$q = $conn->query("SELECT p.*, u.fullname FROM posts p JOIN users u ON p.user_id = u.id ORDER BY p.created_at DESC");
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Blog Home</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <header class="header">
    <h1><a href="index.php">My Blog</a></h1>
    <nav>
      <?php if(isset($_SESSION['user_id'])): ?>
        <span>Hi, <?=htmlspecialchars($_SESSION['user_name'])?></span>
        <a href="create.php" class="btn">New Post</a>
        <a href="auth/logout.php" class="btn subtle">Logout</a>
      <?php else: ?>
        <a href="auth/login.php" class="btn">Login</a>
        <a href="auth/register.php" class="btn subtle">Register</a>
      <?php endif; ?>
    </nav>
  </header>

  <main>
    <?php while($post = $q->fetch_assoc()): ?>
      <article class="card">
        <?php if($post['image']): ?>
          <img src="uploads/<?=htmlspecialchars($post['image'])?>" alt="" class="thumb">
        <?php endif; ?>
        <h2><a href="view.php?slug=<?=urlencode($post['slug'])?>"><?=htmlspecialchars($post['title'])?></a></h2>
        <p class="meta">By <?=htmlspecialchars($post['fullname'])?> • <?=htmlspecialchars($post['created_at'])?></p>
        <p><?=nl2br(htmlspecialchars(substr($post['content'],0,200)))?>...</p>
        <p><a href="view.php?slug=<?=urlencode($post['slug'])?>" class="btn small">Read more</a>
          <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id']==$post['user_id']): ?>
            <a href="edit.php?id=<?=$post['id']?>" class="btn small subtle">Edit</a>
            <a href="delete.php?id=<?=$post['id']?>" class="btn small danger" onclick="return confirm('Are you sure to delete this post?')">Delete</a>
          <?php endif; ?>
        </p>
      </article>
    <?php endwhile; ?>
  </main>
</div>
</body>
</html>
