<?php
require 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }
$user_id = (int)$_SESSION['user_id'];

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$task = null;
if ($id) {
    $stmt = $conn->prepare("SELECT * FROM tasks WHERE id=? AND user_id=?");
    $stmt->bind_param('ii',$id,$user_id);
    $stmt->execute();
    $task = $stmt->get_result()->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $priority = in_array($_POST['priority'] ?? '', ['low','medium','high']) ? $_POST['priority'] : 'medium';
    $due = $_POST['due_date'] ? $_POST['due_date'] : null;
    $stmt = $conn->prepare("UPDATE tasks SET title=?,description=?,priority=?,due_date=? WHERE id=? AND user_id=?");
    $stmt->bind_param('ssssii',$title,$description,$priority,$due,$id,$user_id);
    $stmt->execute();
    header('Location: index.php'); exit;
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Edit Task</title><link rel="stylesheet" href="style.css"></head><body>
<div class="auth-card">
  <h2><?= $task ? 'Edit Task' : 'Manage Tasks' ?></h2>

  <?php if ($task): ?>
    <form method="post">
      <input class="input" type="hidden" name="id" value="<?= $task['id'] ?>">
      <input class="input" name="title" value="<?= htmlspecialchars($task['title']) ?>" required>
      <textarea class="input" name="description"><?= htmlspecialchars($task['description']) ?></textarea>
      <select class="input" name="priority">
        <option value="low" <?= $task['priority']=='low'?'selected':'' ?>>Low</option>
        <option value="medium" <?= $task['priority']=='medium'?'selected':'' ?>>Medium</option>
        <option value="high" <?= $task['priority']=='high'?'selected':'' ?>>High</option>
      </select>
      <input class="input" type="date" name="due_date" value="<?= $task['due_date'] ?>">
      <button class="btn button">Save</button>
      <a href="index.php" class="btn subtle" >Back</a>
    </form>
  <?php else: ?>
    <p><a href="index.php">Back to board</a></p>
  <?php endif; ?>
</div>
</body></html>
