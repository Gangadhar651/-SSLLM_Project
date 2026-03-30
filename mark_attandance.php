<?php
session_start();
include('../config/db.php');

$user_id = $_SESSION['user_id'];
$lecture_id = $_POST['lecture_id'];

$check = $conn->query("SELECT * FROM attendance 
WHERE user_id=$user_id AND lecture_id=$lecture_id");

if($check->num_rows == 0){
    $conn->query("INSERT INTO attendance (user_id, lecture_id) 
    VALUES ($user_id, $lecture_id)");
}

header("Location: ../pages/lectures.php");
exit();
?>