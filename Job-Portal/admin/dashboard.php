<?php
session_start();
require '../db.php';
if(!isset($_SESSION['admin'])) header('Location: login.php');

$jobs = $conn->query("SELECT * FROM jobs ORDER BY created_at DESC");
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Admin Dashboard</title><link rel="stylesheet" href="../style.css"></head>
<body>
<div class="container">
  <h1>Admin Dashboard</h1>
  <nav><a href="add-job.php" class="btn">Add Job</a> <a href="logout.php" class="btn subtle">Logout</a></nav>
  <h2>Jobs</h2>
  <?php while($j = $jobs->fetch_assoc()): ?>
    <div class="card">
      <h3><?=htmlspecialchars($j['title'])?></h3>
      <p><?=htmlspecialchars($j['company'])?> • <?=htmlspecialchars($j['location'])?></p>
      <p style="display:flex; flex-direction:row; padding: 10px;">
        <a href="edit-job.php?id=<?=$j['id']?>" class="btn small subtle" style="margin:0px 10px;">Edit</a>
        <a href="manage-applicants.php?job_id=<?=$j['id']?>" class="btn small" style="margin:0px 10px;">Applicants</a>
        <a href="delete-job.php?id=<?=$j['id']?>" class="btn small danger" style="margin:0px 10px;" onclick="return confirm('Delete this job?')">Delete</a>
      </p>
    </div>
  <?php endwhile; ?>
</div>
</body></html>
