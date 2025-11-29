<?php
session_start();
require '../db.php';

if($_SERVER['REQUEST_METHOD'] !== 'POST'){ header('Location: ../index.php'); exit; }

$job_id = (int)($_POST['job_id'] ?? 0);
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$cover = trim($_POST['cover_letter'] ?? '');

$resume_name = null;
if(isset($_FILES['resume']) && $_FILES['resume']['error']===0){
    $allowed = ['pdf','doc','docx'];
    $ext = strtolower(pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION));
    if(!in_array($ext,$allowed)){
        die('Invalid resume format. Only PDF/DOC/DOCX allowed.');
    }
    $resume_name = time().'-'.bin2hex(random_bytes(6)).'.'.$ext;
    $target = __DIR__ . '/../uploads/resumes/' . $resume_name;
    if(!move_uploaded_file($_FILES['resume']['tmp_name'], $target)){
        die('Failed to save resume.');
    }
}

$user_id = $_SESSION['user_id'] ?? null;

$stmt = $conn->prepare("INSERT INTO applications (job_id,user_id,name,email,resume,cover_letter) VALUES (?,?,?,?,?,?)");
$stmt->bind_param('iissss', $job_id, $user_id, $name, $email, $resume_name, $cover);
$stmt->execute();
$stmt->close();

header('Location: ../jobs/view.php?id=' . $job_id . '&applied=1');
exit;
