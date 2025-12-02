<?php include 'db.php'; ?>

<?php
if(isset($_POST['upload']))
{

    $title = $_POST['title'];

    foreach($_FILES['images']['name'] as $i => $name){

        if($_FILES['images']['error'][$i] === 0){

            $tmp = $_FILES['images']['tmp_name'][$i];
            $fileName = time()."_".$name;
            $path = "uploads/".$fileName;

            move_uploaded_file($tmp, $path);

            $stmt = $conn->prepare("INSERT INTO images(title, file_path) VALUES(?,?)");
            $stmt->bind_param("ss", $title, $path);
            $stmt->execute();
        }
    }

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Upload Images</title>
<link rel="stylesheet" href="style.css">
<script src="script.js" defer></script>
</head>
<body>

<div class="container">
    <h2>Upload Images</h2>

    <form method="POST" enctype="multipart/form-data" id="uploadForm">
        
        <div id="drop-area">
            <p>Drag & Drop images here<br>or</p>
            <input type="text" name="title" id="title" placeholder="Title (Optional)">
            <input type="file" name="images[]" id="fileInput" accept="image/*" multiple hidden>
            <button type="button" id="browseBtn">Browse Files</button>
        </div>

        <div id="preview"></div>

        <button name="upload" class="btn upload-btn">Upload Images</button>

    </form>
</div>

</body>
</html>
