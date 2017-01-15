<?php 
  if(!isset($_SESSION['userid'])){
  session_destroy();
  session_start();
  }
  require_once("./includes/config.php");

  if (isset($_POST['submit'])) {
    $user_id = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE user_id='$user_id' AND password='$password'";   
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
		  <form action="login.php" method="post">
         
      <div class="form-group">
        <label for="">Username :</label>
        <input type="text" class="form-control" name="username" placeholder="Username" required="1">
      </div>

      <div class="form-group">
        <label for="">Password :</label>
        <input type="password" class="form-control" name="password" placeholder="Password" required="1">
      </div>

      <div class="form-group text-center">
        <input type="submit" name="submit" value="Log In" class="btn btn-primary">
        <a href="index.php?register" class="btn btn-warning">Register</a>
      </div>

		</form>
	</div>
	<div class="col-sm-4"></div>
</div>