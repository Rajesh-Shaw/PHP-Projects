<?php include "db.php"; 
$id = $_GET['id'];
$data = $conn->query("SELECT * FROM notes WHERE id=$id")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Note</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
<h2>Edit Note</h2>

<form method="post">
    <input type="text" name="title" value="<?= $data['title'] ?>" required>
    <textarea name="content" rows="5"><?= $data['content'] ?></textarea>

    <select name="tag">
        <option value="work" <?= $data['tag']=='work'?'selected':'' ?>>Work</option>
        <option value="study" <?= $data['tag']=='study'?'selected':'' ?>>Study</option>
        <option value="ideas" <?= $data['tag']=='ideas'?'selected':'' ?>>Ideas</option>
        <option value="other" <?= $data['tag']=='other'?'selected':'' ?>>Other</option>
    </select>

    <button class="btn btn-green">Update</button>
</form>

</div>

</body>
</html>

<?php
if ($_POST){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $tag = $_POST['tag'];

    $conn->query("UPDATE notes SET 
                    title='$title', 
                    content='$content', 
                    tag='$tag' 
                  WHERE id=$id");

    header("Location: index.php");
}
?>
