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

				$query = "SELECT * FROM tests";		
				$stmt = db2_exec($con, $query);
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
				$query1 = "SELECT questions.*,tests.name FROM questions JOIN tests ON questions.topic = tests.name WHERE tests.name = '$row[1]' ";		
					$stmt1 = db2_exec($con, $query1);
					
			 ?>
				<?php while ($questions = db2_fetch_array($stmt1)){?>
		    		<tr>
		    			<td><?php echo $questions[0] ?></td>
		    			<td><?php echo $questions[2] ?></td>
		    			<td><?php echo $questions[3] ?></td>
		    			<td><a href="index.php?editquestion&id=<?php echo $questions[0] ?>">edit</a> - <a href="deletquestion.php?id=<?php echo $questions[0]?>">delete</a></td>
		    		</tr>

				<?php } ?>
			</tbody>
		</table>
		<?php } ?>
		<a href="addquestion.php" class="btn btn-primary">add question(XML)</a>
		
	</div>
	<div class="col-md-3"></div>
</div>


		


	<?php else: ?>

		<?php header("Location: http://localhost/cupu2/index.php?home"); ?>
		

	<?php endif; ?>

