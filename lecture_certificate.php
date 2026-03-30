<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

$lecture = $_GET['lecture'] ?? "Lecture";
?>

<!DOCTYPE html>
<html>
<head>
<title>Certificate</title>

<style>
body {
    font-family: Georgia;
    text-align: center;
    padding: 40px;
    background: #f4f6f9;
}

.cert {
    background: white;
    border: 8px solid #3b82f6;
    padding: 40px;
    max-width: 700px;
    margin: auto;
}

h1 { font-size: 32px; }

.name {
    font-size: 24px;
    font-weight: bold;
    margin: 15px;
}

.btn {
    margin-top: 20px;
    padding: 10px;
    background: #10b981;
    color: white;
    border: none;
    cursor: pointer;
}
</style>
</head>

<body>

<div class="cert">

<h1>🎓 Certificate of Attendance</h1>

<p>This certifies that</p>

<div class="name">Intern</div>

<p>has attended the lecture</p>

<div><?php echo htmlspecialchars($lecture); ?></div>

<p>Date: <?php echo date("d M Y"); ?></p>

<button class="btn" onclick="window.print()">Download</button>

</div>

</body>
</html>