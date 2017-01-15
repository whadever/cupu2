<?php 
	require_once("./includes/config.php");

	if (isset($_POST['submit'])) {
		$no = $_POST['no'];
		$name = $_POST['name'];
		$creator = $_POST['creator'];
		$dynamic = $_POST['dynamic'];
		$duration = $_POST['duration'];
		$total = $_POST['total'];
        
       $query = "INSERT INTO tests (no, name, creator, dynamic,duration,total_question) VALUES ('$no', '$name', '$creator', '$dynamic','$duration','$total')";	

		// By using db2_query I can make sure only one query is submitted blocking sql injection
		// Never use the php multi_query function
		$stmt = db2_exec($con, $query);	

		header("Location: http://localhost/cupu2/index.php?managetests"); 
      
    }
 ?>
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<h1>Add Test</h1>

		<form action="addtest.php" method="post">

			<div class="form-group">
				<label for="">Test No</label>
				<input type="text" class="form-control" name="no">
			</div>
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

		</form>

	</div>
	<div class="col-md-4"></div>
</div>

<script>

	
</script>