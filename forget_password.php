<?php 
  if(!isset($_SESSION['userid'])){
  session_destroy();
  session_start();
  }
  require_once("./includes/config.php");

  if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $stmt = db2_prepare($con, $query);
    if($stmt){
      $result = db2_execute($stmt);
      if (!$result) {
           echo "exec errormsg: " .db2_stmt_errormsg($stmt);
           exit();  
        }

        
        while ($row = db2_fetch_array($stmt)) {
          $_SESSION['role'] = $row[4];
          $_SESSION['last_name'] = $row[2];
          $_SESSION['first_name'] = $row[1];
          $_SESSION['userid'] = $row[0];
        }
        
        header("Location: http://localhost/cupu2/index.php");
        db2_close(); 
        
      
    }else{
      echo "exec errormsg: " . db2_stmt_errormsg($stmt);
    }
  }

 ?>
<div class="row" style="margin-top: 12%;">
	<div class="col-sm-4"></div>
	<div class="col-sm-4 col-xs-12" style="border:1px solid black; padding: 2% 3%; border-radius: 6px; background-color:#eee ">
		 <form action="forget_password.php" method="post">
	      
	      <h2>Please provide us with your User ID (Email)</h2>
	      
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