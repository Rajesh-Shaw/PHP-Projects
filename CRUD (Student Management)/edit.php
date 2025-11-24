<?php include 'db.php'; ?>


<?php
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM students WHERE id=$id");
$row = mysqli_fetch_assoc($result);


if (isset($_POST['update'])) {
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];


mysqli_query($conn, "UPDATE students SET name='$name', email='$email', phone='$phone' WHERE id=$id");
header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Student CRUD</title>
<link rel="stylesheet" href="style.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Student Management</h1>
        </div>

        <form method="post">
            <h2>Update Student</h2>
            <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
            <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
            <input type="text" name="phone" value="<?php echo $row['phone']; ?>" required>
            <button type="submit" name="update" >Update</button>
        </form>
    </div>
</body>
</html>