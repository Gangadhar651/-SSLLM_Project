<?php
include('../config/db.php');
$name=$_POST['name'];
$email=$_POST['email'];
$pass=password_hash($_POST['password'],PASSWORD_DEFAULT);
$role=$_POST['role'];
$conn->query("INSERT INTO users(name,email,password,role) VALUES('$name','$email','$pass','$role')");
header("Location: login.php");
?>