<?php
require 'db.php';
session_start();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';

    if (!$fullname || !$email || !$password) $errors[] = "All fields are required.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email.";
    if ($password !== $password2) $errors[] = "Passwords do not match.";

    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors[] = "Email already registered.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $ins = $conn->prepare("INSERT INTO users (fullname,email,password) VALUES (?,?,?)");
            $ins->bind_param('sss', $fullname, $email, $hash);
            if ($ins->execute()) {
                $_SESSION['user_id'] = $ins->insert_id;
                $_SESSION['user_name'] = $fullname;
                header('Location: index.php');
                exit;
            } else {
                $errors[] = "Registration failed.";
            }
        }
    }
}
?>
<!doctype html>
<html><head>
<meta charset="utf-8"><title>Register - Kanban</title>
<link rel="stylesheet" href="style.css">
</head><body>
<div class="auth-card">
  <h2>Create account</h2>
  <?php if($errors) foreach($errors as $e) echo "<p class='error'>".htmlspecialchars($e)."</p>"; ?>
  <form method="post">
    <input class="input" name="fullname" placeholder="Full name" required>
    <input class="input" name="email" placeholder="Email" required type="email">
    <input class="input" name="password" placeholder="Password" required type="password">
    <input class="input" name="password2" placeholder="Confirm password" required type="password">
    <button class="btn button">Register</button>
  </form>
  <p class="muted">Already have an account? <a href="login.php">Login</a></p>
</div>
</body></html>
