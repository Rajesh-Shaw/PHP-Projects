<?php include "db.php"; ?>

<!DOCTYPE html>
<html>
<head>
<title>Add Note</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
<h2>Add Note</h2>

<form method="post">
    <input type="text" name="title" placeholder="Note Title" required>
    <textarea name="content" rows="5" placeholder="Note Content" required></textarea>

    <select name="tag">
        <option value="work">Work</option>
        <option value="study">Study</option>
        <option value="ideas">Ideas</option>
        <option value="other">Other</option>
    </select>

    <button class="btn btn-green">Save</button>
</form>

</div>

</body>
</html>

<?php
if ($_POST){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $tag = $_POST['tag'];

    $conn->query("INSERT INTO notes (title, content, tag)
                  VALUES ('$title', '$content', '$tag')");

    header("Location: index.php");
}
?>
