<?php 
    include 'db.php'; 
    $id=$_GET['id'];
    $q=mysqli_query($conn,"SELECT * FROM tasks WHERE id=$id"); 
    $t=mysqli_fetch_assoc($q);
?>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="box">
            <form method="post" action="add.php">
                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="text" name="task" value="<?= $t['task'] ?>">
                <input type="date" name="due_date" value="<?= $t['due_date'] ?>">
                <button>Update</button>
            </form>
        </div>
    </body>
</html>