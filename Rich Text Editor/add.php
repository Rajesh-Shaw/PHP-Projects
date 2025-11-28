<!DOCTYPE html>
<html>
<head>
<title>Rich Text Editor</title>
<link rel="stylesheet" href="style.css">
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

</head>
<body>

<div class="container">
    <h2>Create Post</h2>

    <form action="save.php" method="post">
        <input type="text" name="title" placeholder="Post Title" required>

        <textarea name="content" id="editor"></textarea>

        <button type="submit">Publish</button>
    </form>
</div>

<script>
    CKEDITOR.replace('editor');
</script>

</body>
</html>
