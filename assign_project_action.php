<?php
include('../config/db.php');
$uid=$_POST['user_id'];
$pid=$_POST['project_id'];
$conn->query("INSERT INTO assignments(user_id,project_id) VALUES($uid,$pid)");
header("Location: ../pages/assign_project.php");
?>