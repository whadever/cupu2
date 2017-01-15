<?php 


	require_once("./includes/config.php");

	if (isset($_POST['submit'])) {
		$user_id = $_POST['user_id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$password = $_POST['password'];
		$user_id = $_POST['user_id'];
		$role = 'user';
        
       $query = "INSERT INTO users (user_id, last_name, first_name, password,role) VALUES ('$user_id', '$firstname', '$lastname', '$password','$role')";	

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
		session_start();
    	if($_SESSION['userid'] != NULL){
    		header("Location: http://localhost/cupu2/index.php?manageuser");
        }else{
    		header("Location: http://localhost/cupu2/index.php?login");
    	}
        

        	
        db2_close(); 
        
      
    }
 ?>
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<h1>Register</h1>

		<form action="register.php" method="post">

			<div class="form-group">
				<label for="">User ID</label>
				<input type="text" class="form-control" name="user_id" onblur="check_user(this)" id="user_id">
			</div>
			<div class="form-group">
				<label for="">First Name</label>
				<input type="text" class="form-control" name="firstname">
			</div>
			<div class="form-group">
				<label for="">Last Name</label>
				<input type="text" class="form-control" name="lastname">
			</div>
			<div class="form-group">
				<label for="">Password</label>
				<input type="password" minlength="8" class="form-control" onblur="check_pass()" name="password" id="password">
			</div>
			<div class="form-group">
				<label for="">Confirm Password</label>
				<input type="password" minlength="8" class="form-control" onblur="check_pass()" name="conf_pass" id="conf_pass">
			</div>
			<div class="form-group">
				<label for="">Country</label>
				<select name="country" class="form-control" id="">
					<option value="Indonesia">Indonesia</option>
				</select>
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-success" name="submit" value="Sign Up">
			</div>

		</form>

	</div>
	<div class="col-md-4"></div>
</div>

<script>
function check_pass(){
	if($('#password').val() != '' && $('#conf_pass').val() != ''){
		if($('#password').val() != $('#conf_pass').val()){
			$('#password').val('');
			$('#conf_pass').val('');
			alert('password and confirm password did not match');
		}
	}
}

function check_user(el){
	$.ajax({
      url: "check_user.php?user_id="+$(el).val(),
      type: 'GET',
      cache : false,
      success: function(result){
        if(result == 'unavailable'){
            $('#user_id').val('');
            alert('user id has been taken');
        }
       
        
      }
    
    });    
}
	
</script>