<?php
// Optional: dynamic active menu
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<div class="sidebar">
    <h2>SSLLM</h2>

    <ul>
        <!-- Dashboard -->
        <li class="<?= ($currentPage == 'dashboard.php') ? 'active' : '' ?>">
            <a href="dashboard.php">🏠 Dashboard</a>
        </li>

        <!-- NEW Skills Option -->
        <li class="<?= ($currentPage == 'skills.php') ? 'active' : '' ?>">
            <a href="skills.php">🧠 Skills</a>
        </li>

        <!-- Projects -->
        <li class="<?= ($currentPage == 'projects.php') ? 'active' : '' ?>">
            <a href="projects.php">📁 Projects</a>
        </li>
        

        <!-- Lectures -->
        <li class="<?= ($currentPage == 'lectures.php') ? 'active' : '' ?>">
            <a href="lectures.php">🎥 Lectures</a>
        </li>

        <!-- Progress -->
        <li class="<?= ($currentPage == 'progress.php') ? 'active' : '' ?>">
            <a href="progress.php">📊 Progress</a>
        </li>

        <!-- AI -->
        <li class="<?= ($currentPage == 'ai.php') ? 'active' : '' ?>">
            <a href="ai.php">🤖 AI Learning</a>
        </li>
    </ul>

    <hr>

    <ul>
        <li>
            <a href="#">⚙️ Settings</a>
        </li>

        <li>
            <a href="../auth/logout.php">🚪 Logout</a>
        </li>
    </ul>
</div>