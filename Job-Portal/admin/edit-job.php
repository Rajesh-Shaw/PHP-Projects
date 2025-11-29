<?php 
session_start();
require '../db.php';

if(!isset($_SESSION['admin'])) header('Location: login.php');
if(!isset($_GET['id'])) { header("Location: dashboard.php"); exit; }

$job_id = intval($_GET['id']);
$errors = "";

// Fetch job details
$stmt = $conn->prepare("SELECT * FROM jobs WHERE id = ?");
$stmt->bind_param("i", $job_id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows === 0){
    echo "Job not found!";
    exit;
}

$job = $result->fetch_assoc();

// Update logic
if (isset($_POST['update'])) {

    $title       = trim($_POST['title']);
    $company     = trim($_POST['company']);
    $location    = trim($_POST['location']);
    $category    = trim($_POST['category']);
    $type        = trim($_POST['type']);
    $description = trim($_POST['description']);

    if (!$title || !$company || !$description) {
        $errors = "Title, company and description are required.";
    } else {
        $stmt2 = $conn->prepare("UPDATE jobs 
            SET title=?, company=?, location=?, category=?, type=?, description=?
            WHERE id=?");

        $stmt2->bind_param(
            "ssssssi",
            $title,
            $company,
            $location,
            $category,
            $type,
            $description,
            $job_id
        );

        if ($stmt2->execute()) {
            header("Location: dashboard.php?updated=1");
            exit;
        } else {
            $errors = "Failed to update job.";
        }
    }
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Job</title>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="box">
    <h2>Edit Job</h2>

    <?php if($errors): ?>
        <p class="error"><?= htmlspecialchars($errors) ?></p>
    <?php endif; ?>

    <form method="post">

        <input type="text" name="title" 
               placeholder="Job title" 
               value="<?= htmlspecialchars($job['title']) ?>" 
               required>

        <input type="text" name="company" 
               placeholder="Company" 
               value="<?= htmlspecialchars($job['company']) ?>" 
               required>

        <input type="text" name="location" 
               placeholder="Location" 
               value="<?= htmlspecialchars($job['location']) ?>">

        <input type="text" name="category" 
               placeholder="Category" 
               value="<?= htmlspecialchars($job['category']) ?>">

        <input type="text" name="type" 
               placeholder="Type (Full-time)" 
               value="<?= htmlspecialchars($job['type']) ?>">

        <textarea name="description" placeholder="Full description" required><?= htmlspecialchars($job['description']) ?></textarea>

        <button name="update">Update Job</button>

        <a href="dashboard.php" class="back-btn" style="margin-top:15px; display:inline-block;">⬅ Back to Dashboard</a>

    </form>
</div>

</body>
</html>
