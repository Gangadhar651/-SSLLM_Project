<?php
session_start();
include('../config/db.php');

$user_id = $_SESSION['user_id'];

$skill = $conn->query("SELECT AVG(level) as avg_skill FROM user_skills WHERE user_id=$user_id")->fetch_assoc();
$proj = $conn->query("SELECT AVG(progress) as avg_proj FROM assignments WHERE user_id=$user_id")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>

<style>
    /* Dashboard Title */
.main h1 {
    font-size: 24px;
    margin-bottom: 20px;
    font-weight: 600;
}

/* Cards Grid */
.cards {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

/* Card */
.card {
    background: #ffffff;
    border-radius: 12px;
    padding: 20px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    transition: 0.3s;
}

/* Hover effect */
.card:hover {
    transform: translateY(-5px);
}

/* Card Title */
.card h3 {
    font-size: 14px;
    color: #6b7280;
    margin-bottom: 10px;
}

/* Percentage Value */
.card p {
    font-size: 26px;
    font-weight: bold;
    color: #111827;
}

/* Progress Bar Container */
.progress-bar-bg {
    height: 8px;
    background: #e5e7eb;
    border-radius: 5px;
    margin-top: 10px;
}

/* Skill Progress Color */
.skill-progress {
    height: 8px;
    background: #3b82f6;
    border-radius: 5px;
}

/* Project Progress Color */
.project-progress {
    height: 8px;
    background: #10b981;
    border-radius: 5px;
}
</style>
<link rel="stylesheet" href="../assets/css/style.css?v=1">

</head>

<body>

<div class="container">

    <!-- Sidebar -->
    <?php include('../includes/sidebar.php'); ?>

    <div class="main">

        <!-- Topbar -->
        <?php include('../includes/topbar.php'); ?>

        <h1>📊 Dashboard Overview</h1>

        <div class="cards">

            <div class="card">
                <h3>📘 Skill Progress</h3>
                <p><?php echo round($skill['avg_skill']); ?>%</p>

                <div class="progress-bar-bg">
                    <div class="skill-progress" style="width: <?php echo round($skill['avg_skill']); ?>%"></div>
                </div>
            </div>

            <div class="card">
                <h3>📁 Project Progress</h3>
                <p><?php echo round($proj['avg_proj']); ?>%</p>

                <div class="progress-bar-bg">
                    <div class="project-progress" style="width: <?php echo round($proj['avg_proj']); ?>%"></div>
                </div>
            </div>

        </div>

    </div>
</div>

</body>
</html>