<?php
session_start();
include('../config/db.php'); // DB connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>SSLLM Projects</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="container">

    <!-- ===== SIDEBAR ===== -->
    <?php include('../includes/sidebar.php'); ?>

    <!-- ===== MAIN ===== -->
    <div class="main">

        <!-- ===== TOPBAR ===== -->
        <?php include('../includes/topbar.php'); ?>

        <!-- ===== SEARCH ===== -->
        <div class="topbar">
            <h1>🚀 Project Assignments</h1>
            <input type="text" id="search" placeholder="Search projects..." onkeyup="searchProject()">
        </div>

        <!-- ===== FILTER ===== -->
        <div class="filters">
            <button onclick="filter('all')">All</button>
            <button onclick="filter('ongoing')">Ongoing</button>
            <button onclick="filter('completed')">Completed</button>
        </div>

        <!-- ===== PROJECTS ===== -->
        <div class="projects" id="projectList">

            <!-- Project 1 -->
            <div class="card ongoing">
                <h3>Inventory Management</h3>
                <p>Stock & Order Tracking System</p>

                <span class="badge ongoing">Ongoing</span>

                <form method="POST" action="/SSLLM_Full_Project/actions/take_project.php">
                    <input type="hidden" name="title" value="Inventory Management">
                    <button type="submit">Take Project</button>
                </form>
            </div>

            <!-- Project 2 -->
            <div class="card completed">
                <h3>Sales Data Analysis</h3>
                <p>Analyze company sales data</p>

                <span class="badge completed">Completed</span>

                <form method="POST" action="../actions/take_project.php">
                    <input type="hidden" name="title" value="Sales Data Analysis">
                    <button type="submit">Take Project</button>
                </form>
            </div>

            <!-- Project 3 -->
            <div class="card ongoing">
                <h3>HR Dashboard</h3>
                <p>Employee analytics system</p>

                <span class="badge ongoing">Ongoing</span>

                <form method="POST" action="../actions/take_project.php">
                    <input type="hidden" name="title" value="HR Dashboard">
                    <button type="submit">Take Project</button>
                </form>
            </div>

        </div>

    </div>
</div>

<!-- ===== JAVASCRIPT ===== -->
<script>

// Search
function searchProject(){
    let input = document.getElementById("search").value.toLowerCase();
    let cards = document.querySelectorAll(".card");

    cards.forEach(card => {
        let text = card.innerText.toLowerCase();
        card.style.display = text.includes(input) ? "block" : "none";
    });
}

// Filter
function filter(type){
    let cards = document.querySelectorAll(".card");

    cards.forEach(card => {
        if(type === "all"){
            card.style.display = "block";
        } else {
            card.style.display = card.classList.contains(type) ? "block" : "none";
        }
    });
}

</script>

</body>
</html>