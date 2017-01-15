<?php 
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$query1 = "SELECT questions.*,tests.name FROM questions JOIN tests ON questions.topic = tests.name WHERE tests.no = '$id' ";	

			// By using db2_query I can make sure only one query is submitted blocking sql injection
			// Never use the php multi_query function
		$stmt1 = db2_exec($con, $query1);
			
		
	}

	$query = "SELECT * FROM tests";

	$stmt = db2_exec($con, $query);

 ?>

<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<h1>Test</h1>

		<form action="addtest.php" method="post">

			
			<?php if(isset($_GET['id'])): ?>
			<div class="form-group">
				<label for="">Test Name</label>
				<input type="text" class="form-control" name="name">
			</div>
			<div class="form-group">
				<label for="">Creator</label>
				<input type="text" class="form-control" name="creator" value="<?php echo $_SESSION['first_name'] ?>">
			</div>

			<div class="form-group">
				<label for="">Dynamic</label>
				<select class="form-control" name="dynamic" id="">
					<option value="0">no</option>
					<option value="1">yes</option>
				</select>
			</div>
			<div class="form-group">
				<label for="">Duration</label>
				<input type="text" class="form-control" name="duration">
			</div>
			<div class="form-group">
				<label for="">Total Question</label>
				<input type="text" class="form-control" name="total" >
			</div>

			<div class="form-group">
				<input type="submit" class="btn btn-success" name="submit" value="Add">
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