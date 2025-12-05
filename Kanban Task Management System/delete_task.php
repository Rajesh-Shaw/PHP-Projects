<?php
require 'db.php';
session_start();
if(!isset($_SESSION['user_id'])){ header('Location: login.php'); exit; }
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id) {
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id=? AND user_id=?");
    $stmt->bind_param('ii',$id,$_SESSION['user_id']);
    $stmt->execute();
}
header('Location: index.php');
exit;
