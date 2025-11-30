<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>PHP Quiz App</title>

<style>
body {
    font-family: Arial;
    background: #f4f6f9;
    margin: 0;
    padding: 0;
    display: flex;
}

.sidebar {
    width: 220px;
    background: #2e59d9;
    height: 100vh;
    padding-top: 20px;
    position: fixed;
    top: 0;
    left: 0;
    overflow-y: auto;
}

.sidebar h3 {
    text-align: center;
    color: #fff;
    margin-bottom: 15px;
}

.sidebar a {
    display: inline-block;
    padding: 12px;
    color: white;
    text-decoration: none;
    border-bottom: 1px solid rgba(255,255,255,0.2);
    transition: 0.3s;
    background: #0a1842ff;
    margin : 2px;

}

.sidebar a:hover {
    background: rgba(255, 255, 255, 0.2);
}

.active-q {
    background: rgba(255,255,255,0.4);
}

.container {
    margin-left: 240px;
    width: 70%;
    background: #fff;
    padding: 20px;
    margin-top: 20px;
    border-radius: 10px;
}

.question-box {
    padding: 15px;
    margin-bottom: 20px;
    border-left: 5px solid #4e73df;
    background: #fafafa;
    border-radius: 8px;
}

.submit-btn {
    padding: 12px 25px;
    background: green;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 18px;
    cursor: pointer;
}
</style>

</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h3>Questions</h3>

    <?php
    $nav = $conn->query("SELECT id FROM questions");
    $i = 1;
    while($q = $nav->fetch_assoc()){
        echo '<a href="#q'.$q['id'].'" id="nav'.$q['id'].'">'.$i.'</a>';
        $i++;
    }
    ?>
</div>

<!-- Quiz Content -->
<div class="container">
<h2>PHP Quiz – All Questions</h2>

<form action="submit.php" method="post">

<?php
$q = $conn->query("SELECT * FROM questions");
while($row = $q->fetch_assoc()){
?>
<div class="question-box" id="q<?= $row['id'] ?>">
  <p><b><?= $row['id'] ?>. <?= $row['question'] ?></b></p>

  <label><input type="radio" name="answer[<?= $row['id'] ?>]" value="1"> <?= $row['option1'] ?></label><br>
  <label><input type="radio" name="answer[<?= $row['id'] ?>]" value="2"> <?= $row['option2'] ?></label><br>
  <label><input type="radio" name="answer[<?= $row['id'] ?>]" value="3"> <?= $row['option3'] ?></label><br>
  <label><input type="radio" name="answer[<?= $row['id'] ?>]" value="4"> <?= $row['option4'] ?></label><br>
</div>
<?php } ?>

<button type="submit" class="submit-btn">Submit Quiz</button>

</form>
</div>

<script>
// highlight active question link
document.querySelectorAll(".sidebar a").forEach(link => {
    link.addEventListener("click", function() {
        document.querySelectorAll(".sidebar a").forEach(a => a.classList.remove("active-q"));
        this.classList.add("active-q");
    });
});
</script>

</body>
</html>
