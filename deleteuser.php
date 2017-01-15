<?php
require_once("./includes/config.php");
$userid = $_GET["userid"];
$query = "DELETE FROM users WHERE user_id='$userid'";	

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
?>