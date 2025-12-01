<?php include "db.php"; ?>
<!DOCTYPE html>
<html>
<head>
<title>Notes App</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<button class="theme-toggle" onclick="toggleTheme()">Theme</button>

<div class="container">
<h1>Notes App</h1>

<div class="top-bar">
    <input type="text" id="search" placeholder="Search notes...">
    <select id="tagFilter">
        <option value="">All Tags</option>
        <option value="work">Work</option>
        <option value="study">Study</option>
        <option value="ideas">Ideas</option>
        <option value="other">Other</option>
    </select>
    <a href="add.php" class="btn btn-green">+ Add Note</a>
</div>

<div id="notesArea">
    <!-- AJAX OUTPUT -->
</div>

</div>

<script>
// Load Notes on Page Load
loadNotes();

// AJAX Search + Filter
document.getElementById("search").onkeyup = loadNotes;
document.getElementById("tagFilter").onchange = loadNotes;

function loadNotes() {
    let searchText = document.getElementById("search").value;
    let tag = document.getElementById("tagFilter").value;

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "search.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function() {
        document.getElementById("notesArea").innerHTML = this.responseText;
    }

    xhr.send("search=" + searchText + "&tag=" + tag);
}

// Light/Dark Theme
function toggleTheme(){
    document.body.classList.toggle("dark");
}
</script>

</body>
</html>
