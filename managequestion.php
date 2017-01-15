<?php
	// Initialize a session.

    require_once("./includes/config.php");

?>
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<h1>Manage Questions</h1>
		<?php	if (isset($_SESSION['userid'])):

				if ($_SESSION['role'] != 'admin') {
					header("Location: http://localhost/cupu2/index.php"); 
				}

				$query = "SELECT * FROM category";		
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

		<?php while ($row = db2_fetch_array($stmt)){?>
		<h1><?php echo ucfirst($row[1]) ?></h1>
		<table class="table table-bordered">
			<thead>
				<th>ID</th>
				<th>Difficulty</th>
				<th>Questions</th>
				<th>Operations</th>
			</thead>
			<tbody>
			<?php 
				$query = "SELECT questions.*,category.name FROM questions,category WHERE questions.topic ='$row[0]' ";		
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
				<?php while ($questions = db2_fetch_array($stmt)){?>
		    		<tr>
		    			<td><?php echo $questions[0] ?></td>
		    			<td><?php echo $questions[2] ?></td>
		    			<td><?php echo $questions[3] ?></td>
		    			<td><a href="index.php?edituser&user_id=<?php echo $questions[0] ?>">edit</a> - <a href="deleteuser.php?userid=<?php echo $questions[0]?>">delete</a></td>
		    		</tr>

				<?php } ?>
			</tbody>
		</table>
		<?php } ?>
		<a href="index.php?register" class="btn btn-primary">add user</a>
		
	</div>
	<div class="col-md-3"></div>
</div>


		


	<?php else: ?>

		<?php header("Location: http://localhost/cupu2/index.php?home"); ?>
		

	<?php endif; ?>

