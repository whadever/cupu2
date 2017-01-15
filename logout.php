<?php
	// Initialize a session.

	session_start();

    require_once("includes/config.php");
?>


	<?php

    // If no first_name variable exists, redirect the user.

	if (!isset($_SESSION['first_name'])) {

		header("Location: http://localhost/cupu2/index.php");

		exit(); // Quit the script.

	} else { // Logout the user.


	$_SESSION = array(); // Destroy the variables.

	session_destroy(); // Destroy the session itself.

	setcookie (session_name(), '', time()-300, '/', '', 0); // Destroy the cookie.

	header("Location: http://localhost/cupu2/index.php");

	}

	

	?>