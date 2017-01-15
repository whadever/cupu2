<?php
	// Initialize a session.

    require_once("./includes/config.php");

?>
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<h1 class="text-center" style="margin-bottom: 40px">Manage Test</h1>
		<?php	if (isset($_SESSION['userid'])):

				if ($_SESSION['role'] != 'admin') {
					header("Location: http://localhost/cupu2/index.php"); 
				}

				$query = "SELECT * FROM tests";		
				$stmt = db2_exec($con, $query);
		?>
		
		<table class="table table-bordered">
			<thead>
				<th>Test no.</th>
				<th>Test Name</th>
				<th>Creator</th>
				<th>Dynamic</th>
				<th>Duration</th>
				<th>Total Question</th>
				<th>Operations</th>
			</thead>
			<tbody>
			<?php 
				$query = "SELECT * from tests ";		
					$stmt = db2_exec($con, $query);
					
			 ?>
				<?php while ($tests = db2_fetch_assoc($stmt)){?>
		    		<tr>
		    			<td><?php echo $tests['NO'] ?></td>
		    			<td><?php echo $tests['NAME'] ?></td>
		    			<td><?php echo $tests['CREATOR'] ?></td>
		    			<td><?php echo $tests['DYNAMIC'] ?></td>
		    			<td><?php echo $tests['DURATION'] ?></td>
		    			<td><?php echo $tests['TOTAL_QUESTION'] ?></td>
		    			<td><a href="index.php?edittest&id=<?php echo $tests['NO'] ?>">Edit</a> - <a href="deletetest.php?id=<?php echo $tests['NO']?>">Delete</a></td>
		    		</tr>

				<?php } ?>
			</tbody>
		</table>
		<a href="index.php?addtest" class="btn btn-primary">Add Test</a>
		
	</div>
	<div class="col-md-3"></div>
</div>


		


	<?php else: ?>

		<?php header("Location: http://localhost/cupu2/index.php?home"); ?>
		

	<?php endif; ?>

