<?php 
  if(!isset($_SESSION['userid'])){
  session_destroy();
  session_start();
  }
  require_once("./includes/config.php");

  if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $query = "SELECT * FROM users WHERE user_id='$email'";   
    $stmt = db2_exec($con, $query);

    while($row = db2_fetch_assoc($stmt)){
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      mail($email,'Instructions to Reset Password','Here is your new password'.$randomString);
      $query = "UPDATE users set password='$randomString' WHERE user_id='$email'"; 
    }    
    
    header("Location: http://localhost/cupu2/index.php");
    db2_close(); 
  }

 ?>
<div class="row" style="margin-top: 12%;">
	<div class="col-sm-4"></div>
	<div class="col-sm-4 col-xs-12" style="border:1px solid black; padding: 2% 3%; border-radius: 6px; background-color:#eee ">
		 <form action="forget_password.php" method="post">
	      
	      <h4>Please provide us with your User ID (Email)</h4>
	      
	      <div class="form-group">
	        <label for="">User ID (same as your email address) :</label>
	        <input type="text" class="form-control" name="email" placeholder="email" required="1">
	      </div>

	      <div class="form-group text-center">
	        <input type="submit" name="submit" value="Please Mail Me Instructions to Reset My Password" class="btn btn-primary">
	      </div>

		</form>
	</div>
	<div class="col-sm-4"></div>
</div>