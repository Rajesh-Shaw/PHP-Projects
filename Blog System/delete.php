<?php
session_start();
require 'db.php';
if(!isset($_SESSION['user_id'])) header('Location: auth/login.php');

$id = (int)($_GET['id'] ?? 0);

// ensure owner
$stmt = $conn->prepare("SELECT user_id,image FROM posts WHERE id = ?");
$stmt->bind_param('i',$id);
$stmt->execute();
$res = $stmt->get_result();
$post = $res->fetch_assoc();
$stmt->close();
if(!$post) { header('Location: index.php'); exit; }
if($post['user_id'] != $_SESSION['user_id']) { header('Location: index.php'); exit; }

// delete image file if exists
if($post['image'] && file_exists('uploads/'.$post['image'])) {
    @unlink('uploads/'.$post['image']);
}

$del = $conn->prepare("DELETE FROM posts WHERE id = ?");
$del->bind_param('i',$id);
$del->execute();
$del->close();

header('Location: index.php');
exit;
