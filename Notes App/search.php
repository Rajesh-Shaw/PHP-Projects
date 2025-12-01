<?php
include "db.php";

$search = $_POST['search'] ?? "";
$tag = $_POST['tag'] ?? "";

$query = "SELECT * FROM notes WHERE 1";

if ($search != "") {
    $query .= " AND (title LIKE '%$search%' OR content LIKE '%$search%')";
}

if ($tag != "") {
    $query .= " AND tag='$tag'";
}

$query .= " ORDER BY id DESC";

$result = $conn->query($query);

if ($result->num_rows == 0) {
    echo "<p>No notes found.</p>";
}

while ($row = $result->fetch_assoc()) {
?>
<div class="note-card">
    <h3><?= $row['title'] ?></h3>
    <p><?= nl2br($row['content']) ?></p>
    <small><b>Tag:</b> <?= $row['tag'] ?></small><br><br>

    <a class="btn" href="edit.php?id=<?= $row['id'] ?>">Edit</a>
    <a class="btn btn-red" href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete note?')">Delete</a>
</div>
<?php
}
?>
