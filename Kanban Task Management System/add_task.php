<?php
require 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }
$user_id = (int)$_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $priority = in_array($_POST['priority'] ?? '', ['low','medium','high']) ? $_POST['priority'] : 'medium';
    $due_date = $_POST['due_date'] ? $_POST['due_date'] : null;

    if ($title) {
        $stmt = $conn->prepare("INSERT INTO tasks (user_id,title,description,priority,due_date) VALUES (?,?,?,?,?)");
        $stmt->bind_param('issss', $user_id, $title, $description, $priority, $due_date);
        $stmt->execute();
    }
}
header('Location: index.php');
exit;
