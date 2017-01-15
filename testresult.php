<?php
	// Initialize a session.

    require_once("./includes/config.php");

?>
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<h1>View Test Result</h1>
		<?php	

		if (isset($_SESSION['userid'])):
			
				$user_id = $_SESSION['userid'];
				$query = "SELECT test_result.*,tests.name FROM test_result JOIN tests ON test_result.test_no = tests.no WHERE test_result.user_id ='$user_id'";		
				$stmt = db2_exec($con, $query);
		?>
		
		<table class="table table-bordered">
			<thead>
				<th>Test no.</th>
				<th>Test name</th>
				<th>Score</th>
			</thead>
			<tbody>
				<?php while ($tests = db2_fetch_assoc($stmt)){?>
		    		<tr>
		    			<td><?php echo $tests['TEST_NO'] ?></td>
		    			<td><?php echo $tests['NAME'] ?></td>
		    			<td><?php echo $tests['SCORE'] ?></td>
		    		</tr>

				<?php } ?>
			</tbody>
		</table>
		<a href="index.php" class="btn btn-primary">Back</a>		
	</div>
	<div class="col-md-3"></div>
</div>


		


	<?php else: ?>

		<?php header("Location: http://localhost/cupu2/index.php?home"); ?>
		

	<?php endif; ?>

