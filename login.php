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
    $stmt = db2_exec($con, $query);
    

        
    while ($row = db2_fetch_assoc($stmt)) {
      $_SESSION['role'] = $row['ROLE'];
      $_SESSION['last_name'] = $row['LAST_NAME'];
      $_SESSION['first_name'] = $row['FIRST_NAME'];
      $_SESSION['userid'] = $row['USER_ID'];
    }
    
    header("Location: http://localhost/cupu2/index.php");
    db2_close(); 
        
      
   
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

      <div class="form-group text-center">
        <a href="index.php?forget_password">Lost your password</a>
      </div>


		</form>
	</div>
	<div class="col-sm-4"></div>
</div>