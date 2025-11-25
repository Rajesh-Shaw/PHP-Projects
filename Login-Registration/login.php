<?php include 'db.php'; ?>

<?php
$error = "";

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($result);

    if($user && password_verify($password, $user['password']))
    {
        $_SESSION['user'] = $user['fullname'];
        header("Location: dashboard.php");
    } 
    else 
    {
        $error = "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <?php if($error) echo "<p class='error'>$error</p>"; ?>

    <form method="post">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login" class="btn">Login</button>
        <p>No account? <a href="register.php">Register</a></p>
    </form>
</div>
</body>
</html>
