<?php
session_start();
require '../db.php';

$errors = '';

if(isset($_POST['register'])) 
{
    $name = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if(!$name || !$email || !$password) 
    {
        $errors = 'All fields are required.';
    } 
    else 
    {
        // check duplicate email
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0)
        {
            $errors = 'Email already registered.';
        } 
        else 
        {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $ins = $conn->prepare("INSERT INTO users (fullname,email,password) VALUES (?,?,?)");
            $ins->bind_param('sss', $name, $email, $hash);
            if($ins->execute()){
                header('Location: login.php?registered=1');
                exit;
            } else {
                $errors = 'Registration failed. Try again.';
            }
        }
        $stmt->close();
    }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Register</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="box">
  <h2>Create account</h2>
  <?php if($errors): ?><p class="error"><?=htmlspecialchars($errors)?></p><?php endif; ?>
  <form method="post">
    <input type="text" name="fullname" placeholder="Full name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button name="register">Register</button>
    <p>Already have an account? <a href="login.php">Login</a></p>
  </form>
</div>
</body>
</html>
