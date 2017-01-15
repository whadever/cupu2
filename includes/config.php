<?php

 if ($con = db2_connect('project', '', '')) { 
 	
 	

 } else {

 // Print a message to the user, and kill the script.

 echo("Could not connect to DB2!");

 exit();

 }


function escape_data ($data) {

 if (function_exists('db2_real_escape_string')) {

 global $con;

 $data = db2_real_escape_string (trim($data), $con);

 $data = strip_tags($data);

 } else {

 $data = db2_escape_string (trim($data));

 $data = strip_tags($data);

 }

 return $data;

}

?>