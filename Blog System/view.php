<?php
session_start();
require 'db.php';

$slug = $_GET['slug'] ?? '';
$stmt = $conn->prepare("SELECT p.*, u.fullname FROM posts p JOIN users u ON p.user_id=u.id WHERE p.slug = ?");
$stmt->bind_param('s',$slug);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();
if(!$post){
    echo "Post not found"; exit;
}
$stmt->close();

// fetch comments
$cm = $conn->prepare("SELECT * FROM comments WHERE post_id = ? ORDER BY created_at ASC");
$cm->bind_param('i',$post['id']);
$cm->execute();
$comments = $cm->get_result();
$cm->close();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title><?=htmlspecialchars($post['title'])?></title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <article class="single">
    <h1><?=htmlspecialchars($post['title'])?></h1>
    <p class="meta">By <?=htmlspecialchars($post['fullname'])?> • <?=htmlspecialchars($post['created_at'])?></p>
    <?php if($post['image']): ?>
      <img src="uploads/<?=htmlspecialchars($post['image'])?>" alt="" class="post-image">
    <?php endif; ?>
    <div class="content"><?=nl2br(htmlspecialchars($post['content']))?></div>


    <div class="post-navigation">
        <a href="index.php" class="nav-btn">⬅ Back to Home</a>
    </div>
    

    <section class="comments">
      <h3>Comments (<?=$comments->num_rows?>)</h3>
      <?php while($c = $comments->fetch_assoc()): ?>
        <div class="comment">
          <p><strong><?=htmlspecialchars($c['name'])?></strong> • <?=htmlspecialchars($c['created_at'])?></p>
          <p><?=nl2br(htmlspecialchars($c['content']))?></p>
        </div>
      <?php endwhile; ?>

      <h4>Leave a comment</h4>
      <form action="comment.php" method="post">
        <input type="hidden" name="post_id" value="<?=$post['id']?>">
        <input type="text" name="name" placeholder="Your name" required>
        <input type="email" name="email" placeholder="Your email" required>
        <textarea name="content" placeholder="Your comment" required></textarea>
        <button>Post Comment</button>
      </form>
    </section>
  </article>
  <div class="goto-top-navigation">
        <a href="#top" class="nav-btn" style="text-align:center;">⬆ Go to Top</a>
    </div>
</div>
</body>
</html>

