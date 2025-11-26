<?php
session_start(); 
include 'db.php';

if(!isset($_SESSION['user_id'])) 
    header("Location: auth/login.php");
$id = $_SESSION['user_id'];
?>

<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <div class="container">
        <h1>My To-Do List</h1>
            <form action="add.php" method="post" class="add-form">
            <input type="text" name="task" placeholder="Enter task..." required>
            <input type="date" name="due_date" required>
            <button>Add Task</button>
        </form>
        <ul>
            <?php
            $r = mysqli_query($conn,"SELECT * FROM tasks WHERE user_id=$id ORDER BY id DESC");
            while($t=mysqli_fetch_assoc($r)){
            ?>
                <li class="<?= $t['status']=='Completed'?'done':'' ?>">
                <strong><?= $t['task'] ?></strong> - <?= $t['due_date'] ?>
                <div class="actions">
                    <a href="update.php?id=<?= $t['id'] ?>" style="color:green">✔</a>
                    <a href="edit.php?id=<?= $t['id'] ?>">✏️</a>
                    <a href="delete.php?id=<?= $t['id'] ?>" onclick="return confirm('Are you want to delete ?');" >❌</a>
                </div></li>
            <?php } ?>
        </ul>
        <a href="auth/logout.php" class="logout">Logout</a>
    </div>
    </body>
</html>