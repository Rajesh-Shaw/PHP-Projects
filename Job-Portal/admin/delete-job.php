<?php
session_start();
require '../db.php';
if(!isset($_SESSION['admin'])) header('Location: login.php');
$id = (int)($_GET['id'] ?? 0);
$del = $conn->prepare("DELETE FROM jobs WHERE id = ?");
$del->bind_param('i',$id);
$del->execute();
header('Location: dashboard.php'); exit;
