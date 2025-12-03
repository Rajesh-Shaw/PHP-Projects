<?php
require 'db.php';
$id = intval($_GET['id'] ?? 0);
$stmt = $conn->prepare("SELECT * FROM playlists WHERE id = ?");
$stmt->bind_param('i',$id); $stmt->execute(); $pl = $stmt->get_result()->fetch_assoc();
if(!$pl){ echo "Playlist not found"; exit; }

$q = $conn->prepare("SELECT ps.id as psid, s.* FROM playlist_songs ps JOIN songs s ON ps.song_id=s.id WHERE ps.playlist_id=? ORDER BY ps.pos ASC");
$q->bind_param('i',$id); $q->execute(); $res = $q->get_result();
$songs = $res->fetch_all(MYSQLI_ASSOC);
?>
<!doctype html>
<html><head><meta charset="utf-8"><title><?=htmlspecialchars($pl['name'])?></title><link rel="stylesheet" href="style.css"></head>
<body>
<div class="topbar">
  <h1>Playlist: <?=htmlspecialchars($pl['name'])?></h1>
  <a href="index.php" class="btn subtle">Back</a>
</div>

<div class="container">
  <div class="player-box">
    <div id="now-info"><div id="now-title">No track selected</div><div id="now-artist"></div></div>
    <audio id="audio" preload="metadata"></audio>
    <div class="controls">
      <button id="prevBtn" class="control">⏮</button>
      <button id="playBtn" class="control">▶</button>
      <button id="nextBtn" class="control">⏭</button>
      <input type="range" id="progress" value="0" min="0" max="100">
      <span id="time">0:00 / 0:00</span>
      <input type="range" id="volume" min="0" max="1" step="0.01" value="1">
    </div>
  </div>

  <h3>Songs</h3>
  <ol id="queueList">
  <?php foreach($songs as $s): ?>
    <li data-src="<?=htmlspecialchars($s['file_path'])?>" data-title="<?=htmlspecialchars($s['title'])?>" data-artist="<?=htmlspecialchars($s['artist'])?>"><?=htmlspecialchars($s['title'])?> <a href="#" class="remove" data-id="<?=$s['psid']?>">Remove</a></li>
  <?php endforeach; ?>
  </ol>
</div>

<script>
const songs = <?= json_encode($songs) ?>;
</script>
<script src="script.js"></script>
</body>
</html>
