<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>AI Learning</title>

<link rel="stylesheet" href="../assets/css/style.css">

<style>

/* Page title */
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
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 15px;
}

/* Cards */
.card {
    background: white;
    padding: 15px;
    border-radius: 10px;
    border-left: 5px solid;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.courses { border-color: #3b82f6; }
.videos { border-color: #f59e0b; }
.training { border-color: #10b981; }
.path { border-color: #8b5cf6; }

ul {
    padding-left: 18px;
}

li {
    margin: 6px 0;
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

        <h1 class="page-title">🤖 AI Learning Recommendations</h1>

        <!-- Role Selection -->
        <select id="role" onchange="loadRecommendations()">
            <option value="">-- Select Role --</option>
            <option value="Web Developer">Web Developer</option>
            <option value="Data Scientist">Data Scientist</option>
            <option value="Cybersecurity">Cybersecurity</option>
        </select>

        <div class="grid">

            <div class="card courses">
                <h3>📚 Courses</h3>
                <ul id="courses"></ul>
            </div>

            <div class="card videos">
                <h3>🎥 Videos</h3>
                <ul id="videos"></ul>
            </div>

            <div class="card training">
                <h3>🏢 Internal Training</h3>
                <ul id="training"></ul>
            </div>

            <div class="card path">
                <h3>🎯 Learning Path</h3>
                <ul id="path"></ul>
            </div>

        </div>

    </div>
</div>

<script>

const aiData = {

    "Web Developer": {
        courses: ["HTML & CSS", "JavaScript", "React JS"],
        videos: ["Build Portfolio Website", "React Project Tutorial"],
        training: ["Frontend Bootcamp", "Git & Deployment"],
        path: [
            "Learn HTML/CSS",
            "Master JavaScript",
            "Build Projects",
            "Learn React",
            "Apply for Internship"
        ]
    },

    "Data Scientist": {
        courses: ["Python", "Machine Learning", "Data Analysis"],
        videos: ["Pandas Tutorial", "ML Model Building"],
        training: ["Data Bootcamp", "AI Workshop"],
        path: [
            "Learn Python",
            "Data Cleaning",
            "ML Algorithms",
            "Projects",
            "Internship Ready"
        ]
    },

    "Cybersecurity": {
        courses: ["Networking", "Ethical Hacking", "Cyber Laws"],
        videos: ["Pen Testing Demo", "Security Basics"],
        training: ["Security Lab Training", "Firewall Setup"],
        path: [
            "Learn Networking",
            "Security Basics",
            "Practice Tools",
            "Real Case Study",
            "Certification"
        ]
    }
};

function loadRecommendations() {

    let role = document.getElementById("role").value;

    document.getElementById("courses").innerHTML = "";
    document.getElementById("videos").innerHTML = "";
    document.getElementById("training").innerHTML = "";
    document.getElementById("path").innerHTML = "";

    if (!role) return;

    let data = aiData[role];

    data.courses.forEach(item => {
        document.getElementById("courses").innerHTML += `<li>${item}</li>`;
    });

    data.videos.forEach(item => {
        document.getElementById("videos").innerHTML += `<li>${item}</li>`;
    });

    data.training.forEach(item => {
        document.getElementById("training").innerHTML += `<li>${item}</li>`;
    });

    data.path.forEach(item => {
        document.getElementById("path").innerHTML += `<li>${item}</li>`;
    });
}

</script>

</body>
</html>