<?php 
require 'db.php';
session_start();

$errors = [];

/* Ensure upload folder exists */
$uploadDir = "assets/music/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    if (!isset($_FILES['files'])) {
        $errors[] = "No files uploaded.";
    } 
    else 
    {
        $files = $_FILES['files'];

        for ($i = 0; $i < count($files['name']); $i++) 
        {
            if ($files['error'][$i] !== UPLOAD_ERR_OK) {
                $errors[] = "Upload error: " . $files['name'][$i];
                continue;
            }

            $tmp  = $files['tmp_name'][$i];
            $orig = basename($files['name'][$i]);
            $ext  = strtolower(pathinfo($orig, PATHINFO_EXTENSION));

            if (!in_array($ext, ['mp3','wav','ogg','m4a'])) {
                $errors[] = "Invalid format: $orig";
                continue;
            }

            $safe = time() . "_" . bin2hex(random_bytes(4)) . "." . $ext;
            $dest = $uploadDir . $safe;

            if (!move_uploaded_file($tmp, $dest)) {
                $errors[] = "Failed to move file: $orig";
                continue;
            }

            $title = trim($_POST['title'][$i] ?? "");
            if ($title === "") $title = pathinfo($orig, PATHINFO_FILENAME);

            $artist = trim($_POST['artist'][$i] ?? "");

            $stmt = $conn->prepare("INSERT INTO songs (title, artist, file_path) VALUES (?,?,?)");
            if (!$stmt) {
                $errors[] = "SQL PREPARE FAILED: " . $conn->error;
                continue;
            }

            if (!$stmt->bind_param("sss", $title, $artist, $dest)) {
                $errors[] = "SQL BIND FAILED: " . $stmt->error;
                continue;
            }

            if (!$stmt->execute()) {
                $errors[] = "SQL EXECUTE FAILED: " . $stmt->error;
                continue;
            }
        }
    }

    if (empty($errors)) {
        $_SESSION['upload_success'] = true;
    } else {
        $_SESSION['upload_errors'] = $errors;
    }

    header("Location: upload.php");
    exit;
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Upload Music</title>

<style>
body{
    margin:0;
    padding:0;
    font-family:Poppins, sans-serif;
    background: #f4f7ff;
    color:#fff;
}

.container{
    width:480px;
    margin:60px auto;
    background:#4e73df;
    padding:25px;
    border-radius:15px;
    box-shadow:0 4px 20px rgba(0,0,0,0.3);
    animation:fadeIn .7s;
}

@keyframes fadeIn{
    from{opacity:0; transform:translateY(20px);}
    to{opacity:1; transform:translateY(0);}
}

h2{ text-align:center; margin-bottom:20px; }

input[type="file"]{
    width:100%;
    padding:10px;
    background:#fff;
    border-radius:10px;
    color:#333;
}

.meta-row{
    background:rgba(255,255,255,0.2);
    padding:12px;
    margin-top:15px;
    border-radius:10px;
}

.meta-row input{
    width:100%;
    padding:8px;
    margin:6px 0;
    border:none;
    border-radius:8px;
}

.btn{
    width:100%;
    padding:12px;
    margin-top:20px;
    margin-bottom:20px;
    background:#00c9a7;
    border:none;
    border-radius:10px;
    font-size:17px;
    cursor:pointer;
    font-weight:bold;
    color:#fff;
    transition:.3s;
}

.btn:hover{
    background:#00a98b;
}

#status-success{
    background:#2ecc71;
    padding:12px;
    border-radius:10px;
    margin-bottom:15px;
    text-align:center;
}

#status-error{
    background:#e74c3c;
    padding:12px;
    border-radius:10px;
    margin-bottom:15px;
}

.progress-bar{
    width:0%;
    height:7px;
    background:#00eaff;
    border-radius:10px;
    margin-top:5px;
}
</style>
</head>
<body>

<div class="container">

<h2>Upload Music</h2>

<!-- Status Messages (SESSION-based, FIXED) -->
<?php if(isset($_SESSION['upload_success'])): ?>
    <div id="status-success">✔ Music successfully uploaded!</div>
    <?php unset($_SESSION['upload_success']); ?>
<?php endif; ?>

<?php if(isset($_SESSION['upload_errors'])): ?>
    <div id="status-error">
        <b>Some files failed:</b><br>
        <?php 
            foreach($_SESSION['upload_errors'] as $e) {
                echo "• ".htmlspecialchars($e)."<br>";
            }
            unset($_SESSION['upload_errors']);
        ?>
    </div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data" id="uploadForm">

    <input type="file" name="files[]" id="files" accept="audio/*" multiple required>

    <div id="metaArea"></div>

    <button type="submit" class="btn">Upload Music</button>

    <a href="index.php" class="btn" style="background:#444;">Back</a>

</form>
</div>

<script>
const filesInput = document.getElementById('files');
const metaArea = document.getElementById('metaArea');

filesInput.onchange = () => {
    metaArea.innerHTML = '';
    Array.from(filesInput.files).forEach((file, idx) => {
        const name = file.name.replace(/\.[^/.]+$/, "");

        metaArea.insertAdjacentHTML('beforeend', `
            <div class="meta-row">
                <label>Title</label>
                <input type="text" name="title[]" value="${name}">
                
                <label>Artist</label>
                <input type="text" name="artist[]" placeholder="Artist name">

                <div class="progress-bar" id="progress${idx}"></div>
            </div>
        `);
    });
};
</script>

</body>
</html>
