<?php
// Optional: fetch username
$name = $_SESSION['user_name'] ?? "Intern";
?>
<style>
    /* ===== TOPBAR ===== */
.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: white;
    padding: 12px 20px;
    border-bottom: 1px solid #e5e7eb;
    border-radius: 8px;
}

/* Left */
.top-left h2 {
    margin: 0;
    font-size: 20px;
    color: #111827;
}

/* Search */
.top-search input {
    padding: 8px 12px;
    border-radius: 6px;
    border: 1px solid #d1d5db;
    width: 250px;
}

/* Right */
.top-right {
    display: flex;
    align-items: center;
    gap: 15px;
}

/* Icon */
.icon {
    font-size: 18px;
    cursor: pointer;
}

/* User */
.user {
    font-weight: 500;
    color: #374151;
}

/* Logout */
.logout-btn {
    padding: 6px 12px;
    background: #ef4444;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.logout-btn:hover {
    background: #dc2626;
}
</style>

<div class="topbar">

    <!-- Left Section -->
    <div class="top-left">
        <h2>SSLLM Dashboard</h2>
    </div>

    <!-- Center Search -->
    <div class="top-search">
        <input type="text" placeholder="Search projects, skills...">
    </div>

    <!-- Right Section -->
    <div class="top-right">

        <!-- Notification -->
        <div class="icon">
            🔔
        </div>

        <!-- User -->
        <div class="user">
            <span><?php echo $name; ?></span>
        </div>

        <!-- Logout -->
        <a href="../auth/logout.php">
            <button class="logout-btn">Logout</button>
        </a>

    </div>

</div>