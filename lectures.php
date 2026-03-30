<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

// 👉 Static data (same as your JS, now in PHP)
$lectures = [
    ["name"=>"Building Dashboard","company"=>"Google","topic"=>"Frontend + Backend","start"=>"5:00 PM","end"=>"6:00 PM","status"=>"Live"],
    ["name"=>"Machine Learning","company"=>"Infosys","topic"=>"Dataset Processing","start"=>"6:30 PM","end"=>"7:30 PM","status"=>"Upcoming"],
    ["name"=>"Cybersecurity Basics","company"=>"IBM","topic"=>"Network Security","start"=>"4:00 PM","end"=>"5:00 PM","status"=>"Ended"],
    ["name"=>"Cloud Computing","company"=>"Amazon","topic"=>"AWS Basics","start"=>"7:00 PM","end"=>"8:00 PM","status"=>"Live"],
    ["name"=>"Data Analytics","company"=>"Wipro","topic"=>"Power BI","start"=>"3:00 PM","end"=>"4:00 PM","status"=>"Ended"],
    ["name"=>"DevOps Pipeline","company"=>"TCS","topic"=>"CI/CD Tools","start"=>"8:00 PM","end"=>"9:00 PM","status"=>"Upcoming"],
    ["name"=>"UI/UX Design","company"=>"Adobe","topic"=>"Figma","start"=>"2:00 PM","end"=>"3:00 PM","status"=>"Ended"],
    ["name"=>"Android Development","company"=>"Samsung","topic"=>"App Dev","start"=>"5:30 PM","end"=>"6:30 PM","status"=>"Live"],
    ["name"=>"AI in Industry","company"=>"Microsoft","topic"=>"AI Apps","start"=>"9:00 PM","end"=>"10:00 PM","status"=>"Upcoming"]
];
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Live Lectures</title>

<link rel="stylesheet" href="../assets/css/style.css">

<style>

/* Grid */
.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 15px;
}

/* Card */
.card {
    background: white;
    padding: 15px;
    border-radius: 10px;
    border-left: 6px solid;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

/* Status colors */
.live { border-color: #10b981; }
.upcoming { border-color: #f59e0b; }
.ended { border-color: #ef4444; }

/* Buttons */
.btn {
    margin-top: 10px;
    padding: 8px 14px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.join { background: #10b981; color: white; }
.cert { background: #3b82f6; color: white; }

.btn:hover { opacity: 0.9; }

</style>

</head>

<body>

<div class="container">

    <!-- Sidebar -->
    <?php include('../includes/sidebar.php'); ?>

    <div class="main">

        <!-- Topbar -->
        <?php include('../includes/topbar.php'); ?>

        <h1>🎥 Live Lecture Dashboard</h1>

        <div class="grid">

        <?php foreach($lectures as $index => $lec){ ?>

            <div class="card <?php echo strtolower($lec['status']); ?>">

                <h3><?php echo $lec['name']; ?></h3>

                <p><b>Company:</b> <?php echo $lec['company']; ?></p>
                <p><b>Topic:</b> <?php echo $lec['topic']; ?></p>
                <p><b>Time:</b> <?php echo $lec['start']; ?> - <?php echo $lec['end']; ?></p>
                <p><b>Status:</b> <?php echo $lec['status']; ?></p>

                <!-- Join -->
                <?php if($lec['status'] == 'Live'){ ?>
                    <button class="btn join" onclick="joinLecture('<?php echo $lec['name']; ?>')">
                        Join Live
                    </button>
                <?php } ?>

                <!-- Certificate -->
                <?php if($lec['status'] == 'Ended'){ ?>
                    <a href="/SSLLM_Full_Project/pages/lecture_certificate.php?lecture=<?php echo urlencode($lec['name']); ?>" target="_blank">
                        <button class="btn cert">Certificate</button>
                    </a>
                <?php } ?>

            </div>

        <?php } ?>

        </div>

    </div>
</div>

<script>
function joinLecture(name){
    alert("Joining: " + name);
}
</script>

</body>
</html>