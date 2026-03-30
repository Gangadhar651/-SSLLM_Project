<?php
session_start();
include('../config/db.php');

$user_id = $_SESSION['user_id'];

// Update progress
if(isset($_POST['update_project'])){
    $id = $_POST['id'];
    $progress = $_POST['progress'];

    $status = ($progress == 100) ? 'Completed' : 'Ongoing';

    $conn->query("UPDATE assignments 
    SET progress=$progress, status='$status' 
    WHERE id=$id AND user_id=$user_id");
}

$result = $conn->query("SELECT * FROM assignments WHERE user_id=$user_id");
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">

<?php include('../includes/sidebar.php'); ?>

<div class="main">
<h1>📁 My Projects</h1>

<?php while($row = $result->fetch_assoc()){ ?>

<div class="card">

<h3><?php echo $row['project_title']; ?></h3>

<!-- Progress bar -->
<div style="background:#ddd;height:8px;border-radius:5px;">
<div style="width:<?php echo $row['progress']; ?>%;background:#10b981;height:8px;"></div>
</div>

<p><?php echo $row['progress']; ?>%</p>
<p>Status: <?php echo $row['status']; ?></p>

<!-- Update -->
<form method="POST">
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
<input type="number" name="progress" min="0" max="100" required>
<button name="update_project">Update</button>
<?php if($row['status'] == 'Completed'){ ?>
    <a href="certificate.php?project_id=<?php echo $row['id']; ?>" target="_blank">
        <button>🎓 Get Certificate</button>
    </a>
<?php } ?>
</form>

</div>

<?php } ?>

</div>
</div>

</body>
</html>