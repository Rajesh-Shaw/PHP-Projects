<?php
require 'db.php';
$id = intval($_GET['id'] ?? 0);
if(!$id) { header('Location:index.php'); exit;}
$stmt = $conn->prepare("SELECT file_path FROM songs WHERE id = ?");
$stmt->bind_param('i',$id); $stmt->execute(); $r = $stmt->get_result()->fetch_assoc();
if($r && file_exists($r['file_path'])) @unlink($r['file_path']);
$d = $conn->prepare("DELETE FROM songs WHERE id = ?");
$d->bind_param('i',$id); $d->execute();
header('Location:index.php');
