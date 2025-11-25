<?php include 'db.php'; ?>
<?php
if(!isset($_SESSION['user'])){
header("Location: login.php");
}
?>


<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h2>Welcome, <?php echo $_SESSION['user']; ?> 👋</h2>
<a href="logout.php" class="btn">Logout</a>
</div>
</body>
</html>