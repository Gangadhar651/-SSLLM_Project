<?php
session_start();
include('../config/db.php');
$email = $_POST['email'];
$password = $_POST['password'];
$res = $conn->query("SELECT * FROM users WHERE email='$email'");
$user = $res->fetch_assoc();
if($user && password_verify($password,$user['password'])){
$_SESSION['user_id']=$user['id'];
$_SESSION['role']=$user['role'];
header("Location: ../pages/dashboard.php");
} else { echo "Invalid Login"; }
?>