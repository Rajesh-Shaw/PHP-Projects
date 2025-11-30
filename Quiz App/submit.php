<?php
session_start();
include 'db.php';

$answers = $_POST['answer'];
$_SESSION['score'] = 0;

$q = $conn->query("SELECT * FROM questions");
while($row = $q->fetch_assoc()){
    $id = $row['id'];
    $correct = $row['correct_option'];

    if(isset($answers[$id]) && $answers[$id] == $correct){
        $_SESSION['score']++;
    }
}

header("Location: result.php");
exit;
?>
