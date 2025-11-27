<?php
require 'db.php';
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $post_id = (int)$_POST['post_id'];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $content = trim($_POST['content']);

    $stmt = $conn->prepare("INSERT INTO comments (post_id,name,email,content) VALUES (?,?,?,?)");
    $stmt->bind_param('isss', $post_id, $name, $email, $content);
    $stmt->execute();
    $stmt->close();

    // find post slug to redirect back
    $s = $conn->prepare("SELECT slug FROM posts WHERE id = ?");
    $s->bind_param('i',$post_id);
    $s->execute();
    $res = $s->get_result();
    $row = $res->fetch_assoc();
    $s->close();

    if($row){
        header('Location: view.php?slug=' . urlencode($row['slug']));
    } else {
        header('Location: index.php');
    }
    exit;
}
