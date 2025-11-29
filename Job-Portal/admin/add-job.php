<?php
session_start();
require '../db.php';
if(!isset($_SESSION['admin'])) header('Location: login.php');
$errors='';
if(isset($_POST['create'])){
    $title = trim($_POST['title']);
    $company = trim($_POST['company']);
    $location = trim($_POST['location']);
    $category = trim($_POST['category']);
    $type = trim($_POST['type']);
    $description = trim($_POST['description']);
    if(!$title || !$company || !$description) $errors='Title, company and description required.';
    else {
        $stmt = $conn->prepare("INSERT INTO jobs (title,company,location,category,type,description) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param('ssssss',$title,$company,$location,$category,$type,$description);
        if($stmt->execute()){
            header('Location: dashboard.php'); exit;
        } else $errors='Failed to add job.';
    }
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Add Job</title><link rel="stylesheet" href="../style.css"></head>
<body>
<div class="box"><h2>Add Job</h2>
<?php if($errors): ?><p class="error"><?=htmlspecialchars($errors)?></p><?php endif; ?>
<form method="post">
  <input type="text" name="title" placeholder="Job title" required>
  <input type="text" name="company" placeholder="Company" required>
  <input type="text" name="location" placeholder="Location">
  <input type="text" name="category" placeholder="Category">
  <input type="text" name="type" placeholder="Type (Full-time)">
  <textarea name="description" placeholder="Full description" required></textarea>
  <button name="create">Create Job</button>
</form></div></body></html>
