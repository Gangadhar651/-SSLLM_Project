
<?php
session_start();
include('../config/db.php');

// Enable errors (for debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check login
if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Check project_id
if(!isset($_GET['project_id'])){
    die("Invalid Project");
}

$project_id = (int)$_GET['project_id'];

// Get user
$user = $conn->query("SELECT name FROM users WHERE id=$user_id")->fetch_assoc();

// Get project
$project = $conn->query("SELECT * FROM assignments WHERE id=$project_id AND user_id=$user_id")->fetch_assoc();

if(!$project){
    die("Project not found");
}

// OPTIONAL: only allow completed
if($project['status'] != 'Completed'){
    die("❌ Complete project first!");
}

// Get lectures attended
$lectures = $conn->query("
    SELECT lectures.title 
    FROM attendance 
    JOIN lectures ON attendance.lecture_id = lectures.id
    WHERE attendance.user_id=$user_id
");

$lectureList = "";

if($lectures && $lectures->num_rows > 0){
    while($row = $lectures->fetch_assoc()){
        $lectureList .= $row['title'] . ", ";
    }
} else {
    $lectureList = "No lectures recorded";
}

// Remove last comma
$lectureList = rtrim($lectureList, ", ");

// Certificate ID
$cert_id = "CERT-" . rand(1000,9999);
?>

<!DOCTYPE html>
<html>
<head>
<title>Certificate</title>

<style>
body {
    font-family: Georgia;
    background: #f4f6f9;
    text-align: center;
    padding: 40px;
}

.certificate {
    background: white;
    border: 10px solid #3b82f6;
    padding: 40px;
    max-width: 800px;
    margin: auto;
    border-radius: 10px;
}

h1 {
    font-size: 36px;
    margin-bottom: 20px;
}

.name {
    font-size: 28px;
    font-weight: bold;
    margin: 20px 0;
}

.project {
    font-size: 20px;
    margin: 15px 0;
}

.lectures {
    font-size: 16px;
    margin: 10px 0;
    color: #555;
}

.footer {
    margin-top: 40px;
    display: flex;
    justify-content: space-between;
}

.btn {
    margin-top: 20px;
    padding: 10px 15px;
    background: #3b82f6;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}
</style>
</head>

<body>

<div class="certificate">

<h1>🏆 Certificate of Completion</h1>

<p>This certifies that</p>

<div class="name"><?php echo htmlspecialchars($user['name']); ?></div>

<p>has successfully completed the project</p>

<div class="project">📁 <?php echo htmlspecialchars($project['project_title']); ?></div>

<p>and attended lectures:</p>

<div class="lectures"><?php echo htmlspecialchars($lectureList); ?></div>

<div class="footer">
    <div>Date: <?php echo date("d M Y"); ?></div>
    <div>ID: <?php echo $cert_id; ?></div>
</div>

<!-- Print Button -->
<button class="btn" onclick="window.print()">🖨 Download / Print</button>

</div>

</body>
</html>