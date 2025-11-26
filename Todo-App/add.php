<?php
    session_start(); 
    include 'db.php';

    $t=$_POST['task'];
    $d=$_POST['due_date']; 
    $u=$_SESSION['user_id'];

    mysqli_query($conn,"INSERT INTO tasks(task,due_date,user_id) VALUES('$t','$d','$u')");
    header("Location:index.php");
?>