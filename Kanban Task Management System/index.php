<?php
require 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }
$user_id = (int)$_SESSION['user_id'];

// fetch tasks for this user (simple per-user board)
$tasks = ['todo'=>[], 'inprogress'=>[], 'done'=>[]];
$stmt = $conn->prepare("SELECT * FROM tasks WHERE user_id=? ORDER BY created_at DESC");
$stmt->bind_param('i',$user_id);
$stmt->execute();
$res = $stmt->get_result();
while($t = $res->fetch_assoc()){
    $tasks[$t['status']][] = $t;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Kanban Board</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header class="topbar">
  <div class="brand">Kanban Board</div>
  <div class="user-area">
    <span class="muted">Hi, <?=htmlspecialchars($_SESSION['user_name'])?></span>
    <a href="logout.php" class="btn subtle">Logout</a>
  </div>
</header>

<div class="container-kanban">
  <div class="board-top">
    <form id="addForm" action="add_task.php" method="post" class="inline-form">
      <input name="title" placeholder="New task title" required>
      <select name="priority">
        <option value="medium">Priority</option>
        <option value="low">Low</option>
        <option value="medium" selected>Medium</option>
        <option value="high">High</option>
      </select>
      <button class="btn">Add Task</button>
      <a href="edit_task.php" class="btn subtle" style="margin-left:8px;">Manage</a>
    </form>
  </div>

  <div class="board">
    <?php foreach(['todo'=>'To Do','inprogress'=>'In Progress','done'=>'Done'] as $key => $label): ?>
      <div class="column" data-status="<?= $key ?>">
        <h3><?= $label ?></h3>
        <div class="dropzone" id="zone-<?= $key ?>">
          <?php foreach($tasks[$key] as $task): ?>
            <div class="card" draggable="true" data-id="<?= $task['id'] ?>">
              <div class="card-top">
                <strong><?= htmlspecialchars($task['title']) ?></strong>
                <span class="badge <?= htmlspecialchars($task['priority']) ?>"><?= htmlspecialchars($task['priority']) ?></span>
              </div>
              <p class="muted small"><?= nl2br(htmlspecialchars(substr($task['description'],0,120))) ?></p>
              <div class="card-foot">
                <small class="muted"><?= $task['due_date'] ? htmlspecialchars($task['due_date']) : '' ?></small>
                <div>
                  <a class="link" href="edit_task.php?id=<?= $task['id'] ?>">Edit</a>
                  <a class="link" href="delete_task.php?id=<?= $task['id'] ?>" onclick="return confirm('Delete task?')">Delete</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<script src="script.js"></script>
</body>
</html>
