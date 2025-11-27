<?php
session_start();
require '../db.php';
$error = '';

if(isset($_POST['login'])) 
{
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id,fullname,password FROM users WHERE email = ?");
    $stmt->bind_param('s',$email);
    $stmt->execute();
    $result = $stmt->get_result();
    if($user = $result->fetch_assoc())
    {
        if(password_verify($password, $user['password']))
        {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['fullname'];
            header('Location: ../index.php');
            exit;
        } 
        else 
        {
            $error = 'Invalid credentials.';
        }
    } else {
        $error = 'Invalid credentials.';
    }
    $stmt->close();
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="box">
  <h2>Login</h2>
  <?php if(isset($_GET['registered'])): ?>
    <p class="success">Registration successful — please login.</p>
  <?php endif; ?>
  <?php if($error): ?><p class="error"><?=htmlspecialchars($error)?></p><?php endif; ?>
  <form method="post">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button name="login">Login</button>
    <p>No account? <a href="register.php">Register</a></p>
  </form>
</div>
</body>
</html>
