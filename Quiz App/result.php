<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Quiz Result</title>
<style>
    body {
        margin: 0;
        padding: 0;
        background: #4e73df;
        font-family: "Poppins", sans-serif;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .container {
        width: 400px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(12px);
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0,0,0,0.2);
        text-align: center;
        color: white;
        animation: fadeIn 0.8s ease-in-out;
    }

    h2 {
        margin-top: 0;
        font-size: 28px;
        letter-spacing: 1px;
    }

    .score-box {
        margin: 20px 0;
        background: rgba(255,255,255,0.25);
        padding: 15px;
        font-size: 22px;
        font-weight: 600;
        border-radius: 10px;
    }

    .btn {
        display: inline-block;
        padding: 12px 25px;
        background: linear-gradient(135deg, #1cc88a, #17a673);
        color: white;
        font-weight: 600;
        text-decoration: none;
        border-radius: 30px;
        margin-top: 10px;
        transition: 0.3s ease;
    }

    .btn:hover {
        background: linear-gradient(135deg, #17a673, #13855c);
        transform: scale(1.05);
    }

    @keyframes fadeIn {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
</style>
</head>
<body>

<div class="container">
    <h2>🎉 Quiz Completed!</h2>

    <div class="score-box">
        Your Score: <span><?= $_SESSION['score'] ?></span>
    </div>

    <a href="index.php" class="btn">Try Again</a>
</div>

</body>
</html>
