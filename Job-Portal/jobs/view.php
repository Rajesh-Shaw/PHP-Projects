<?php
require '../db.php';
session_start();

$id = (int)($_GET['id'] ?? 0);
$stmt = $conn->prepare("SELECT * FROM jobs WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$res = $stmt->get_result();
$job = $res->fetch_assoc();
$stmt->close();
if(!$job){ echo "Job not found"; exit; }
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title><?=htmlspecialchars($job['title'])?></title><link rel="stylesheet" href="../style.css"></head>
<body>
<div class="container">
  <a href="../index.php" class="btn subtle">← Back to Listings</a>
  <div class="box">
    <h1><?=htmlspecialchars($job['title'])?></h1>
    <p class="meta"><?=htmlspecialchars($job['company'])?> • <?=htmlspecialchars($job['location'])?> • <?=htmlspecialchars($job['type'])?></p>
    <div class="content"><?=nl2br(htmlspecialchars($job['description']))?></div>
  </div>

  <div class="box">
    <h3>Apply for this job</h3>
    <?php if(isset($_GET['applied']) && $_GET['applied']=='1'): ?>
      <p class="success">Application submitted successfully.</p>
    <?php endif; ?>
    <form action="../user/apply.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="job_id" value="<?=$job['id']?>">
      <input type="text" name="name" placeholder="Your name" required>
      <input type="email" name="email" placeholder="Your email" required>
      <input type="file" name="resume" accept=".pdf,.doc,.docx" required>
      <textarea name="cover_letter" placeholder="Cover letter (optional)"></textarea>
      <button type="submit">Submit Application</button>
    </form>
  </div>
</div>
</body>
</html>
