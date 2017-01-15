<?php 
require_once("./includes/config.php");
	if(isset($_GET['user_id'])){
		$userid = $_GET['user_id'];
		$query = "SELECT * FROM users WHERE user_id='$userid'";   
	    $stmt = db2_prepare($con, $query);
	    if($stmt){
	      $result = db2_execute($stmt);
	      
	   }
	   $row = db2_fetch_array($stmt);
	   if(count($row) <= 1){
	   		echo 'available';
	   }else{
	   		echo 'unavailable';
	   }
	}

 ?>