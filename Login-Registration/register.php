<?php include 'db.php'; ?>

<?php
$success = "";
$error = "";

if(isset($_POST['register']))
{
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    
    if(mysqli_num_rows($check) > 0)
    {
        $error = "Email already registered. Please login.";
    } 
    else 
    {
        $query = "INSERT INTO users(fullname,email,password) VALUES('$name','$email','$password')";
        
        if(mysqli_query($conn, $query))
        {
            $success = "Registration successful! You can now login.";
        } 
        else 
        {
            $error = "Registration failed. Try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Create Account</h2>

    <?php if($error) echo "<p class='error'>$error</p>"; ?>
    <?php if($success) echo "<p class='success'>$success</p>"; ?>

    <form method="post">
        <input type="text" name="fullname" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="register" class="btn">Register</button>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </form>
</div>
</body>
</html>