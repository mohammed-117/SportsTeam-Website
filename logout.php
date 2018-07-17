<?php
//The logout logic for the navbar
	session_start();
	session_destroy();
	echo 'You have been logged out. <a href="login.php">Go back</a>';
?>