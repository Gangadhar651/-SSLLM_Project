<?php include('../config/db.php'); ?>
<form action="../actions/assign_project_action.php" method="POST">
<select name="user_id">
<?php $u=$conn->query("SELECT * FROM users WHERE role='intern'");
while($r=$u->fetch_assoc()){ ?>
<option value="<?php echo $r['id']; ?>"><?php echo $r['name']; ?></option>
<?php } ?>
</select>
<select name="project_id">
<?php $p=$conn->query("SELECT * FROM projects");
while($r=$p->fetch_assoc()){ ?>
<option value="<?php echo $r['id']; ?>"><?php echo $r['title']; ?></option>
<?php } ?>
</select>
<button>Assign</button>
</form>