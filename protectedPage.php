<?php
	include_once('library.php');
	session_start();
	$example = new Library();

 // Check if the user is logged in
 if($_SESSION[YOUR_WEB_LOGIN] == "true")
 {
echo'

<html>

<head>

<title>ECS Sample Protected Page</title>

</head>

<body>

<center><h1>ECS Sample Protected Page</h1></center>

<hr>

<p>

<a href="logout.php">logout</a>

</body>

</html>
';
	}

  // Not logged in
	else {echo"You need to login.  Please go to our <a href='login.php'>login page.</a>";}

?>
