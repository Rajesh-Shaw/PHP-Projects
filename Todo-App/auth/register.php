<?php
include '../db.php';
if(isset($_POST['register']))
{
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    mysqli_query($conn,"INSERT INTO users(fullname,email,password) VALUES('$name','$email','$pass')");
    header("Location: login.php");
}
?>
<html>
    <head>
        <link rel="stylesheet" href="../style.css">
    </head>
    <body>
        <div class="box" style="text-align:center" >
        <h2>Register</h2>
            <form method="post">
                <input type="text" name="fullname" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button name="register">Register</button>
                <p>Already have an account? <a href="login.php">Login</a></p>
            </form>
        </div>
    </body>
</html>