<?php
require 'db.php';
$id = intval($_POST['id'] ?? 0);
if($id){
    $stmt = $conn->prepare("DELETE FROM playlist_songs WHERE id = ?");
    $stmt->bind_param('i',$id);
    $stmt->execute();
    echo json_encode(['status'=>'ok']);
} else echo json_encode(['status'=>'error']);
