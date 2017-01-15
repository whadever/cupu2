<?php 
	require_once("./includes/config.php");
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$query1 = "SELECT questions.*,tests.name FROM questions JOIN tests ON questions.topic = tests.name WHERE tests.no = '$id' ";	
		$query2 = "SELECT COUNT(*) FROM questions JOIN tests ON questions.topic = tests.name WHERE tests.no = '$id' ";
			// By using db2_query I can make sure only one query is submitted blocking sql injection
			// Never use the php multi_query function
		$stmt1 = db2_exec($con, $query1);
		$stmt2 = db2_exec($con, $query2);

		$total_question = db2_fetch_array($stmt2);
		
	}

	$query = "SELECT * FROM tests";

	$stmt = db2_exec($con, $query);

	if(isset($_POST['submit'])){
		print_r($_POST);
		$no = $_POST['test'];
		$query3 = $query1 = "SELECT questions.*,tests.name FROM questions JOIN tests ON questions.topic = tests.name WHERE tests.no = '$no' ";
		$stmt3 = db2_exec($con, $query3);
		$correct = 0;
		$total_question = $_POST['total_question'];
		while ($qu = db2_fetch_assoc($stmt3)) {
			if($_POST['answer'.$qu['ID']] == $qu['CORRECTANSWER']){
				$correct++;
			}
		}
		
		$score = $correct / $total_question * 100;
		session_start();
		$user_id = $_SESSION['userid'];
		
		$query4 = "INSERT INTO test_result(test_no, score, user_id) VALUES('$no','$score','$user_id')";

		$stmt4 = db2_exec($con, $query4);

		header("Location: http://localhost/cupu2/index.php");
		
	}

 ?>

<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<h1>Test</h1>

		<form action="performtest.php" method="post">

			
			<?php if(isset($_GET['id'])): ?>
				<?php $test = db2_fetch_assoc($stmt) ?>
				<div class="form-group">
					<select class="form-control" name="test" id="">
						<option value="<?php echo $test['NO'] ?>"><?php echo $test['NAME'] ?></option>
					
					</select>
				</div>
				<?php while($question = db2_fetch_assoc($stmt1)){ ?>
					<h4><?php echo $question['QUESTION'] ?></h4>
					<div class="radio">
					  <label><input type="radio" name="answer<?php echo $question['ID'] ?>" value="1"><?php echo $question['CHOICE1'] ?></label>
					</div>
					<div class="radio">
					  <label><input type="radio" name="answer<?php echo $question['ID'] ?>" value="2"><?php echo $question['CHOICE2'] ?></label>
					</div>
					<div class="radio">
					  <label><input type="radio" name="answer<?php echo $question['ID'] ?>" value="3"><?php echo $question['CHOICE3'] ?></label>
					</div>
					
				<?php } ?>			
				
				<input type="hidden" name="total_question" value="<?php echo $total_question[0] ?>">
			<div class="form-group">
				<input type="submit" class="btn btn-success" name="submit" value="Submit">
			</div>
			<?php else: ?>
				<div class="form-group">
					<select class="form-control" name="test" id="" onchange="get_question(this)">
						<option value="">Choose a Test</option>
					<?php while ($test = db2_fetch_assoc($stmt)) {?>
						<option value="<?php echo $test['NO'] ?>"><?php echo $test['NAME'] ?></option>
					<?php } ?>
					</select>
				</div>
			<?php endif; ?>
		</form>

	</div>
	<div class="col-md-4"></div>
</div>

<script>
	function get_question(el){
		window.location.assign("http://localhost/cupu2/index.php?performtest&id="+$(el).val());
	}
</script>