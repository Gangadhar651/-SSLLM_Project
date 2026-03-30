<?php
session_start();

// Optional login check
if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Skills Dashboard</title>
<link rel="stylesheet" href="../assets/css/style.css">

<style>

/* Page Title */
.page-title {
    margin-bottom: 20px;
}

/* Dropdown */
select {
    width: 100%;
    padding: 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
}

/* Grid */
.grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
}

/* Cards */
.skill-card {
    background: white;
    padding: 15px;
    border-radius: 10px;
    border-left: 5px solid;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.industrial { border-color: #3b82f6; }
.academic { border-color: #10b981; }
.gap { border-color: #ef4444; }

.skill-card h3 {
    margin-top: 0;
}

/* List */
ul {
    padding-left: 18px;
}

li {
    margin: 6px 0;
}

/* Button */
.analyze-btn {
    margin-top: 20px;
    padding: 10px;
    width: 100%;
    background: #3b82f6;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.analyze-btn:hover {
    background: #2563eb;
}

</style>
</head>

<body>

<div class="container">

    <!-- Sidebar -->
    <?php include('../includes/sidebar.php'); ?>

    <div class="main">

        <!-- Topbar -->
        <?php include('../includes/topbar.php'); ?>

        <h1 class="page-title">📊 Skill Requirement Dashboard</h1>

        <!-- Dropdown -->
        <select id="role" onchange="updateData()">
            <option value="">-- Select Role / Department --</option>
            <option value="Web Developer">Web Developer</option>
            <option value="Data Scientist">Data Scientist</option>
            <option value="Cybersecurity Analyst">Cybersecurity Analyst</option>
            <option value="Mechanical Engineer">Mechanical Engineer</option>
            <option value="Civil Engineer">Civil Engineer</option>
        </select>

        <!-- Cards -->
        <div class="grid">

            <div class="skill-card industrial">
                <h3>🏭 Industrial Skills</h3>
                <ul id="industrial"></ul>
            </div>

            <div class="skill-card academic">
                <h3>🎓 Academic Skills</h3>
                <ul id="academic"></ul>
            </div>

            <div class="skill-card gap">
                <h3>⚠️ Skill Gap</h3>
                <ul id="gap"></ul>
            </div>
            <div class="section">
<h3>🏆 Certification</h3>

<a href="certificate.php" target="_blank">
    <button>Download Certificate</button>
</a>
</div>

        </div>

        <button class="analyze-btn" onclick="showAlert()">Analyze</button>

    </div>
</div>

<script>

const data = {

    "Web Developer": {
        industrial: ["HTML", "CSS", "JavaScript", "React", "Git"],
        academic: ["HTML", "CSS", "C Programming"]
    },

    "Data Scientist": {
        industrial: ["Python", "Machine Learning", "Pandas", "Statistics"],
        academic: ["Python", "Maths", "Basic Statistics"]
    },

    "Cybersecurity Analyst": {
        industrial: ["Networking", "Ethical Hacking", "Cryptography"],
        academic: ["Computer Networks", "Security Basics"]
    },

    "Mechanical Engineer": {
        industrial: ["Automation", "Robotics", "CAD/CAM"],
        academic: ["Thermodynamics", "Machine Design"]
    },

    "Civil Engineer": {
        industrial: ["Project Management", "Structural Software"],
        academic: ["Surveying", "Construction Tech"]
    }
};

function updateData() {
    let role = document.getElementById("role").value;

    let industrial = document.getElementById("industrial");
    let academic = document.getElementById("academic");
    let gap = document.getElementById("gap");

    industrial.innerHTML = "";
    academic.innerHTML = "";
    gap.innerHTML = "";

    if (!role) return;

    let ind = data[role].industrial;
    let acad = data[role].academic;

    ind.forEach(skill => {
        industrial.innerHTML += `<li>${skill}</li>`;
    });

    acad.forEach(skill => {
        academic.innerHTML += `<li>${skill}</li>`;
    });

    let gapSkills = ind.filter(skill => !acad.includes(skill));

    gapSkills.forEach(skill => {
        gap.innerHTML += `<li>${skill}</li>`;
    });
}

function showAlert() {
    let role = document.getElementById("role").value;

    if (!role) {
        alert("Please select role/department!");
    } else {
        alert("Skill gap analysis completed for " + role);
    }
}

</script>

</body>
</html>