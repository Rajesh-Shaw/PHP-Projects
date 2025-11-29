<?php
require 'db.php';
session_start();

$q = $conn->query("SELECT * FROM jobs ORDER BY created_at DESC");
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Job Portal</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <header class="header">
    <h1><a href="index.php">Job Portal</a></h1>
    <nav>
      <?php if(isset($_SESSION['user_id'])): ?>
        <span>Hi, <?=htmlspecialchars($_SESSION['user_name'])?></span>
        <a href="user/applications.php" class="btn">My Applications</a>
        <a href="user/logout.php" class="btn subtle">Logout</a>
      <?php else: ?>
        <a href="user/login.php" class="btn">Login</a>
        <a href="user/register.php" class="btn subtle">Register</a>
      <?php endif; ?>
      <a href="admin/login.php" class="btn subtle">Admin</a>
    </nav>
  </header>

  <main>
    <?php while($job = $q->fetch_assoc()): ?>
      <article class="card">
        <h2><?=htmlspecialchars($job['title'])?></h2>
        <p class="meta"><?=htmlspecialchars($job['company'])?> • <?=htmlspecialchars($job['location'])?> • <?=htmlspecialchars($job['type'])?></p>
        <p><?=nl2br(htmlspecialchars(substr($job['description'],0,300)))?>...</p>
        <p>
          <a href="jobs/view.php?id=<?=$job['id']?>" class="btn small">View & Apply</a>
        </p>
      </article>
    <?php endwhile; ?>
  </main>
</div>
</body>
</html>
