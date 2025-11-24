<?php include 'db.php'; ?>


<?php
if (isset($_POST['submit'])) 
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];


    mysqli_query($conn, "INSERT INTO students(name,email,phone) VALUES('$name','$email','$phone')");
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
            <h2>Add Student</h2>
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="phone" placeholder="Phone" required>
            <button type="submit" name="submit" >Save</button>
        </form>
    </div>
</body>
</html>