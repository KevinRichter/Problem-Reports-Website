<?php
	include_once('library.php');
	session_start();
	$example = new Library();

	// html Content and headers will be displayed.
	
	$example->logout();
	session_destroy();
	
echo'You have sucessfully logged out.<br> Thank you for visiting.
 <a href="index.html">Click to go back to the main page</a>  ';

?>
