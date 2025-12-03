<?php
require 'db.php';

// Fetch songs
$songs = [];
$res = $conn->query("SELECT * FROM songs ORDER BY uploaded_at DESC");
while ($r = $res->fetch_assoc()) $songs[] = $r;

// Fetch playlists
$playlists = [];
$r2 = $conn->query("SELECT * FROM playlists ORDER BY created_at DESC");
while ($p = $r2->fetch_assoc()) $playlists[] = $p;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Music Player</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Header Bar -->
<div class="topbar">
    <h1>🎵 Music Player</h1>
    <div class="actions">
        <a href="upload.php" class="btn">Upload</a>
        <a href="create_playlist.php" class="btn">Create Playlist</a>
    </div>
</div>

<div class="wrap">

<!-- Sidebar -->
<aside class="left">

    <!-- Songs -->
    <h3>Songs</h3>
    <div class="song-list">

        <?php if(!empty($songs)): ?>
            <?php foreach($songs as $s): 

                $songID     = (int)$s['id'];
                $filePath   = htmlspecialchars($s['file_path']);
                $title      = htmlspecialchars($s['title'] ?: pathinfo($s['file_path'], PATHINFO_FILENAME));
                $artist     = htmlspecialchars($s['artist']);
            ?>

            <div class="song-item" 
                 data-id="<?= $songID ?>" 
                 data-src="<?= $filePath ?>" 
                 data-title="<?= $title ?>" 
                 data-artist="<?= $artist ?>">

                <div class="song-meta">
                    <strong><?= $title ?></strong>
                    <span class="small"><?= $artist ?></span>
                </div>

                <div class="song-actions">
                    <button class="play-btn">Play</button>
                    <a class="add-pl" href="#" data-id="<?= $songID ?>">+Playlist</a>
                    <a class="delete" href="delete_song.php?id=<?= $songID ?>" onclick="return confirm('Delete this song?')">Delete</a>
                </div>

            </div>

            <?php endforeach; ?>
        <?php else: ?>
            <p>No songs uploaded yet.</p>
        <?php endif; ?>

    </div>

    <!-- Playlists -->
    <h3>Playlists</h3>
    <ul class="playlist-list">
        <?php if(!empty($playlists)): ?>
            <?php foreach($playlists as $pl): ?>
                <li>
                    <a href="playlist.php?id=<?= (int)$pl['id'] ?>">
                        <?= htmlspecialchars($pl['name']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>No playlists created yet.</li>
        <?php endif; ?>
    </ul>

</aside>

<!-- Main Player -->
<main class="main">

    <div class="player-box">
        <div id="now-info">
            <div id="now-title">No track selected</div>
            <div id="now-artist"></div>
        </div>

        <audio id="audio" preload="metadata"></audio>

        <div class="controls">
            <button id="prevBtn" class="control">⏮</button>
            <button id="playBtn" class="control">▶</button>
            <button id="nextBtn" class="control">⏭</button>

            <input type="range" id="progress" min="0" max="100" value="0">

            <span id="time">0:00 / 0:00</span>

            <input type="range" id="volume" min="0" max="1" step="0.01" value="1">
        </div>
    </div>

    <!-- Queue -->
    <section class="queue">
        <h3>Queue</h3>
        <ol id="queueList"></ol>
    </section>

</main>

</div>

<script>
    const SONGS_DATA = <?= json_encode($songs, JSON_UNESCAPED_SLASHES) ?>;
</script>

<script src="script.js"></script>

</body>
</html>
