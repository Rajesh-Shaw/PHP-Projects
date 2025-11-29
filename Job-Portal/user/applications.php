<?php
session_start();
require '../db.php';
if(!isset($_SESSION['user_id'])) header('Location: login.php');
$uid = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT a.*, j.title FROM applications a JOIN jobs j ON a.job_id=j.id WHERE a.user_id = ? ORDER BY a.applied_at DESC");
$stmt->bind_param('i',$uid);
$stmt->execute();
$res = $stmt->get_result();
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>My Applications</title><link rel="stylesheet" href="../style.css"></head>
<body>
<div class="container">
  <a href="../index.php" class="btn subtle">← Back</a>
  <h2>My Applications</h2>
  <?php while($a = $res->fetch_assoc()): ?>
    <div class="card">
      <h3><?=htmlspecialchars($a['title'])?></h3>
      <p><?=htmlspecialchars($a['name'])?> • <?=htmlspecialchars($a['email'])?></p>
      <p>Applied at: <?=htmlspecialchars($a['applied_at'])?></p>
      <?php if($a['resume']): ?>
        <p><a href="../uploads/resumes/<?=htmlspecialchars($a['resume'])?>" target="_blank">View Resume</a></p>
      <?php endif; ?>
      <p><?=nl2br(htmlspecialchars($a['cover_letter']))?></p>
    </div>
  <?php endwhile; ?>
</div>
</body>
</html>
