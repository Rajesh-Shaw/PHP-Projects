<?php
require 'db.php';
session_start();
header('Content-Type: application/json');
if (!isset($_SESSION['user_id'])) { echo json_encode(['status'=>'error','msg'=>'Not logged']); exit; }

$user_id = (int)$_SESSION['user_id'];
$data = json_decode(file_get_contents('php://input'), true);
if (!$data) { echo json_encode(['status'=>'error','msg'=>'Bad request']); exit; }

$task_id = (int)($data['task_id'] ?? 0);
$status = $data['status'] ?? '';
if (!in_array($status, ['todo','inprogress','done'])) {
    echo json_encode(['status'=>'error','msg'=>'Invalid status']); exit;
}

$stmt = $conn->prepare("UPDATE tasks SET status=? WHERE id=? AND user_id=?");
$stmt->bind_param('sii',$status,$task_id,$user_id);
if ($stmt->execute()) echo json_encode(['status'=>'ok']);
else echo json_encode(['status'=>'error','msg'=>$stmt->error]);
