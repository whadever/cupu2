<?php
	// Initialize a session.

    require_once("./includes/config.php");

?>
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<h1 class="text-center" style="margin-bottom: 40px;">Manage User</h1>
		<?php	if (isset($_SESSION['userid'])):

				if ($_SESSION['role'] != 'admin') {
					header("Location: http://localhost/cupu2/index.php"); 
				}

				$query = "SELECT user_id, first_name, last_name, password, role FROM users";		
				$stmt = db2_prepare($con, $query);
				if ($stmt) {
				  $result = db2_execute($stmt);
				  if (!$result) {
				     echo "exec errormsg: " .db2_stmt_errormsg($stmt);
				     exit();	
				  }
				} else {
				     echo "exec errormsg: " . db2_stmt_errormsg($stmt);
				}
		?>
		<table class="table table-bordered">
			<thead>
				<th>User ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Role</th>
				<th>Operations</th>
			</thead>
			<tbody>
				<?php while ($row = db2_fetch_array($stmt)){?>
		    		<tr>
		    			<td><?php echo $row[0] ?></td>
		    			<td><?php echo $row[1] ?></td>
		    			<td><?php echo $row[2] ?></td>
		    			<td><?php echo $row[4] ?></td>
		    			<td><a href="index.php?edituser&user_id=<?php echo $row[0] ?>">Edit</a> - <a href="deleteuser.php?userid=<?php echo $row[0]?>">Delete</a></td>
		    		</tr>

				<?php } ?>
			</tbody>
		</table>
		<a href="index.php?register" class="btn btn-primary">Add User</a>
		
	</div>
	<div class="col-md-3"></div>
</div>


		


	<?php else: ?>

		<?php header("Location http:localhost/cupu2/index.php?home"); ?>
		

	<?php endif; ?>

