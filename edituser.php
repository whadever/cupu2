<?php  

	require_once("./includes/config.php");
	if($_SESSION['role'] != 'admin'){
		header("Location: http://localhost/cupu2/index.php?home");
	}
	if(isset($_GET['user_id'])){
		$user_id = $_GET['user_id'];
		$query = "SELECT user_id, last_name, first_name, password, role from users where user_id='$user_id'";	

		// By using db2_query I can make sure only one query is submitted blocking sql injection
		// Never use the php multi_query function
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
		$user = db2_fetch_array($stmt);
	}

	if (isset($_POST['submit'])) {
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$password = $_POST['password'];
		$user_id = $_POST['user_id'];
		$role = $_POST['role'];
        
       $query = "UPDATE users set last_name='$lastname', first_name='$firstname', password='$password',role='$role' WHERE user_id='$user_id'";	

		// By using db2_query I can make sure only one query is submitted blocking sql injection
		// Never use the php multi_query function
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
        
        header("Location: http://localhost/cupu2/index.php?manageuser");
        db2_close(); 
        
      
    }
 ?>

<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<h1>Edit User</h1>

		<form action="edituser.php" method="post">

			<div class="form-group">
				<label for="">User ID</label>
				<input type="text" class="form-control" name="user_id" value="<?php echo $user[0] ?>" readonly='readonly' id="user_id">
			</div>
			<div class="form-group">
				<label for="">Last Name</label>
				<input type="text" class="form-control" value="<?php echo $user[1] ?>" name="lastname">
			</div>
			<div class="form-group">
				<label for="">First Name</label>
				<input type="text" class="form-control" value="<?php echo $user[2] ?>" name="firstname">
			</div>

			<div class="form-group">
				<label for="">Password</label>
				<input type="password" minlength="8" value="<?php echo $user[3] ?>" class="form-control" name="password" id="password">
			</div>
			<div class="form-group">
				<label for="">Role</label>
				<input type="text" class="form-control" value="<?php echo $user[4] ?>" name="role">
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-success" name="submit" value="Save">
			</div>

		</form>

	</div>
	<div class="col-md-4"></div>
</div>
