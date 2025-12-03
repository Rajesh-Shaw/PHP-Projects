<?php
require 'db.php';
$playlist_id = intval($_POST['playlist_id'] ?? 0);
$song_id = intval($_POST['song_id'] ?? 0);

if($playlist_id && $song_id){
    // find max pos
    $q = $conn->prepare("SELECT COALESCE(MAX(pos),0) as mx FROM playlist_songs WHERE playlist_id = ?");
    $q->bind_param('i',$playlist_id); $q->execute(); $r = $q->get_result()->fetch_assoc();
    $pos = $r['mx'] + 1;
    $ins = $conn->prepare("INSERT INTO playlist_songs (playlist_id,song_id,pos) VALUES (?,?,?)");
    $ins->bind_param('iii', $playlist_id, $song_id, $pos);
    $ins->execute();
    echo json_encode(['status'=>'ok']);
} else {
    echo json_encode(['status'=>'error']);
}
