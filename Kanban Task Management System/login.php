<?php
require 'db.php';
session_start();
$err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    if (!$email || !$password) $err = "Enter email and password.";
    else {
        $stmt = $conn->prepare("SELECT id,fullname,password FROM users WHERE email=?");
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($user = $res->fetch_assoc()) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['fullname'];
                header('Location: index.php');
                exit;
            } else $err = "Invalid credentials.";
        } else $err = "Invalid credentials.";
    }
}
?>
<!doctype html>
<html><head>
<meta charset="utf-8"><title>Login - Kanban</title>
<link rel="stylesheet" href="style.css">
</head><body>
<div class="auth-card">
  <h2>Login</h2>
  <?php if($err) echo "<p class='error'>".htmlspecialchars($err)."</p>"; ?>
  <form method="post" >
    <input class="input" name="email" placeholder="Email" required type="email">
    <input class="input" name="password" placeholder="Password" required type="password">
    <button class="btn button">Login</button>
  </form>
  <p class="muted">No account? <a href="register.php">Register</a></p>
</div>
</body></html>
