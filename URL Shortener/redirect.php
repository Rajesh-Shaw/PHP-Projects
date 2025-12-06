<?php
require 'db.php';

if (!isset($_GET['c'])) exit("Invalid Request");

$code = $_GET['c'];

$stmt = $conn->prepare("SELECT id, long_url, clicks FROM links WHERE code=?");
$stmt->bind_param("s", $code);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    exit("URL Not Found");
}

$data = $res->fetch_assoc();
$id    = $data['id'];
$url   = $data['long_url'];
$click = $data['clicks'] + 1;

// Update click count
$u = $conn->prepare("UPDATE links SET clicks=? WHERE id=?");
$u->bind_param("ii", $click, $id);
$u->execute();

// Redirect
header("Location: $url");
exit;
?>
