<?php
require_once("./includes/config.php");
$id = $_GET["id"];
$query = "DELETE FROM tests WHERE no='$id'";	

			// By using db2_query I can make sure only one query is submitted blocking sql injection
			// Never use the php multi_query function
			$stmt = db2_exec($con, $query);
			
	header("Location: http://localhost/cupu2/index.php?managequestion");
?>