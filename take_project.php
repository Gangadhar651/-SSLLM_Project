<?php
session_start();
include('../config/db.php');

// Check login
if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

$user_id = (int)$_SESSION['user_id'];

// Check if form data exists
if(!isset($_POST['title'])){
    die("Invalid request");
}

$title = $conn->real_escape_string($_POST['title']);

// Check duplicate
$check = $conn->query("SELECT * FROM assignments 
WHERE user_id=$user_id AND project_title='$title'");

if(!$check){
    die("Error: " . $conn->error);
}

if($check->num_rows == 0){
    $insert = $conn->query("INSERT INTO assignments (user_id, project_title) 
    VALUES ($user_id, '$title')");

    if(!$insert){
        die("Insert Error: " . $conn->error);
    }
}

// ✅ FIXED PATH
header("Location: ../pages/my_projects.php");
exit();
?>