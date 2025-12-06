<?php
require 'db.php';

$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $long = trim($_POST["long_url"]);
    if ($long === "") {
        $message = "Please enter a URL.";
    } else {

        // Create unique code
        $code = substr(md5(time() . rand()), 0, 6);

        $stmt = $conn->prepare("INSERT INTO links (code, long_url) VALUES (?, ?)");
        $stmt->bind_param("ss", $code, $long);

        if ($stmt->execute()) {
            $shortUrl = "http://" . $_SERVER['HTTP_HOST'] . "/redirect.php?c=$code";
            $message = "Short URL: <a href='$shortUrl' target='_blank'>$shortUrl</a>";
        } else {
            $message = "Error adding URL.";
        }
    }
}

// fetch list
$res = $conn->query("SELECT * FROM links ORDER BY created_at DESC");
?>
<!doctype html>
<html>
<head>
<title>URL Shortener</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="box">
    <h2>🔗 URL Shortener</h2>

    <?php if($message): ?>
        <div class="msg"><?= $message ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="long_url" placeholder="Enter long URL..." required>
        <button type="submit">Shorten</button>
    </form>

    <h3>Your Links</h3>
    <table>
        <tr>
            <th>Short</th>
            <th>Original</th>
            <th>Clicks</th>
        </tr>

        <?php while($row = $res->fetch_assoc()): ?>
        <tr>
            <td><a href="redirect.php?c=<?= $row['code'] ?>" target="_blank">
                <?= $row['code'] ?>
            </a></td>

            <td class="small"><?= htmlspecialchars($row['long_url']) ?></td>
            <td><?= $row['clicks'] ?></td>
        </tr>
        <?php endwhile; ?>

    </table>
</div>

</body>
</html>
