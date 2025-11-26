<?php
session_start();
include '../db.php';
if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $q = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($q);
    if($user && password_verify($pass,$user['password']))
    {
        $_SESSION['user_id']=$user['id'];
        header("Location: ../index.php");
    } 
    else $error = "Invalid credentials";
}
?>
<html>
    <head>
        <link rel="stylesheet" href="../style.css">
    </head>
    <body>
        <div class="box" style="text-align:center">
        <h2>Login</h2>
            <form method="post">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button name="login">Login</button>
                <p><?= $error ?? '' ?></p>
                <p>No account? <a href="register.php">Register</a></p>
            </form>
        </div>
    </body>
</html>