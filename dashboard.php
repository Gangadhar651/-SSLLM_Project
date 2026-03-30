<?php
session_start();
include('../config/db.php');

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// ===== FETCH DATA =====

// Skills
$skills = $conn->query("SELECT COUNT(*) as total FROM user_skills WHERE user_id=$user_id")->fetch_assoc();

// Completed Skills (example logic)
$completedSkills = $skills['total'];
$totalSkills = 20;

// Projects
$projects = $conn->query("SELECT COUNT(*) as total FROM assignments WHERE user_id=$user_id")->fetch_assoc();

// Completed Projects
$completedProjects = $conn->query("SELECT COUNT(*) as total FROM assignments WHERE user_id=$user_id AND status='Completed'")->fetch_assoc();

// Attendance
$attendance = $conn->query("SELECT COUNT(*) as total FROM attendance WHERE user_id=$user_id")->fetch_assoc();

// ===== CALCULATIONS =====
$skillPercent = ($completedSkills / $totalSkills) * 100;
$projectPercent = ($completedProjects['total'] / max(1,$projects['total'])) * 100;
$attendancePercent = min(100, $attendance['total'] * 10);

// Performance Score
$performance = round(($skillPercent + $projectPercent + $attendancePercent) / 3);
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>

<link rel="stylesheet" href="../assets/css/style.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

/* Layout */
.cards {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 15px;
}

/* Card */
.card {
    background: white;
    padding: 20px;
    border-radius: 12px;
    border-left: 5px solid #3b82f6;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

/* Sections */
.section {
    margin-top: 25px;
    background: white;
    padding: 20px;
    border-radius: 12px;
}

/* AI Box */
.ai-box {
    background: #eef2ff;
    border-left: 5px solid #6366f1;
}

/* Buttons */
.btn {
    padding: 8px 12px;
    margin: 5px;
    border: none;
    background: #3b82f6;
    color: white;
    border-radius: 6px;
    cursor: pointer;
}

/* Progress Bar */
.progress {
    height: 8px;
    background: #e5e7eb;
    border-radius: 5px;
    margin-top: 5px;
}

.progress-bar {
    height: 100%;
    background: #3b82f6;
    border-radius: 5px;
}

</style>
</head>

<body>

<div class="container">

<?php include('../includes/sidebar.php'); ?>

<div class="main">

<?php include('../includes/topbar.php'); ?>

<h1>📊 Dashboard</h1>
<p>Welcome back 👋 Here’s your performance overview.</p>

<!-- ===== KPI CARDS ===== -->
<div class="cards">

<div class="card">
<h3>Skills Mastery</h3>
<p><?php echo round($skillPercent); ?>%</p>
<div class="progress"><div class="progress-bar" style="width:<?php echo $skillPercent; ?>%"></div></div>
</div>

<div class="card">
<h3>Projects Delivered</h3>
<p><?php echo $completedProjects['total']; ?> / <?php echo $projects['total']; ?></p>
</div>

<div class="card">
<h3>Attendance Rate</h3>
<p><?php echo $attendancePercent; ?>%</p>
</div>

<div class="card">
<h3>Performance Score</h3>
<p><?php echo $performance; ?>/100</p>
</div>

</div>

<!-- ===== CHART ===== -->
<div class="section">
<h3>📈 Performance Analytics</h3>
<canvas id="chart"></canvas>
</div>

<!-- ===== AI INSIGHTS ===== -->
<div class="section ai-box">
<h3>🤖 AI Insights</h3>
<ul>
<li>You are <?php echo round($skillPercent); ?>% aligned with your role</li>
<li>Improve advanced skills like React & APIs</li>
<li>Complete 1 more project to reach Advanced Level</li>
<li>Maintain attendance above 80%</li>
</ul>
</div>

<!-- ===== ACTION CENTER ===== -->
<div class="section">
<h3>⚡ Action Center</h3>
<button class="btn" onclick="location.href='projects.php'">📁 Projects</button>
<button class="btn" onclick="location.href='lectures.php'">🎥 Lectures</button>
<button class="btn" onclick="location.href='ai.php'">🤖 AI Learning</button>
<button class="btn" onclick="location.href='my_projects.php'">📊 My Work</button>
</div>

<!-- ===== TIMELINE ===== -->
<div class="section">
<h3>📅 Recent Activity</h3>
<ul>
<li>✔ Completed Sales Analysis Project</li>
<li>✔ Attended AI Lecture</li>
<li>✔ Added Skill: JavaScript</li>
<li>⚠ Pending: React Skill Assessment</li>
</ul>
</div>

</div>
</div>

<script>
const ctx = document.getElementById('chart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Skills', 'Projects', 'Attendance'],
        datasets: [{
            label: 'Performance',
            data: [<?php echo $skillPercent; ?>, <?php echo $projectPercent; ?>, <?php echo $attendancePercent; ?>]
        }]
    }
});
</script>

</body>
</html>