<?php
session_start();
require '../db.php';
if(!isset($_SESSION['admin'])) header('Location: login.php');

$job_id = (int)($_GET['job_id'] ?? 0);
$stmt = $conn->prepare("SELECT a.*, j.title FROM applications a JOIN jobs j ON a.job_id = j.id WHERE a.job_id = ? ORDER BY a.applied_at DESC");
$stmt->bind_param('i',$job_id);
$stmt->execute();
$res = $stmt->get_result();
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Applicants</title><link rel="stylesheet" href="../style.css"></head>
<body>
<div class="container">
  <a href="dashboard.php" class="btn subtle">← Back</a>
  <h2>Applicants for Job #<?=$job_id?></h2>
  <?php while($a = $res->fetch_assoc()): ?>
    <div class="card">
      <h3><?=htmlspecialchars($a['name'])?> (<?=htmlspecialchars($a['email'])?>)</h3>
      <p>Applied at: <?=htmlspecialchars($a['applied_at'])?></p>
      <?php if($a['resume']): ?>
        <p><a href="../uploads/resumes/<?=htmlspecialchars($a['resume'])?>" target="_blank">Download Resume</a></p>
      <?php endif; ?>
      <p><?=nl2br(htmlspecialchars($a['cover_letter']))?></p>
    </div>
  <?php endwhile; ?>
</div>
</body>
</html>
