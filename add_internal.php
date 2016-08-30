<?php 
// Adds internal users only. Accessible by Admins only!


		session_start();
		include_once('connect_mysql.php');
		
		if (trim($_SESSION['user_group']) != "admin")
			header("Location:oops.php?msg=You are not an Admin");
			
		$fname = mysql_real_escape_string($_POST['fname']);
		$lname = mysql_real_escape_string($_POST['lname']);
		$email_adr = $_POST['email_adr'];
		$contact = preg_replace("/[^0-9]/", "", $_POST['contact']);
		date_default_timezone_set('America/Los_Angeles');
		$date_added = date('Y-m-d');
		$date_active = $_POST['date_active'];
		$date_inactive = $_POST['date_inactive'];
		$user_group = $_POST['user_group'];
		$username = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string($_POST['password']);
		$password1 = mysql_real_escape_string($_POST['password1']);

		// Check that passwords match
		if ($password != $password1)
			$_SESSION['mismatchError'] = "<-- Passwords did not match!";
		else
		{
			$password = trim($password);
			$_SESSION['mismatchError'] = NULL;
		}
			
		// Check that username is unique
		$result = mysql_query("SELECT username FROM user_info WHERE username='".mysql_real_escape_string($username)."'");
    	if (mysql_num_rows($result) > 0) 
	      	$_SESSION['usernameError'] = "<-- Username is already in use! Chose another...";
		else
			$_SESSION['usernameError'] = NULL;
			
		// Check that all fields are filled in
		if (!$_POST['fname'] || !$_POST['lname'] || !$_POST['email_adr'] || !$_POST['contact'])
	      	$_SESSION['emptyError'] = "You did not complete all of the required fields";
		else
			$_SESSION['emptyError'] = NULL;
		
		// If any errors, return to new_user
		if ($_SESSION['mismatchError'] || $_SESSION['usernameError'] || $_SESSION['emptyError'])
		{
			header("Location: new_user.php");
	      	return;
	    }
			
		// Save user info to database table user_info
		$sql="INSERT INTO user_info (fname, lname, email_adr, contact, user_group, date_added, date_active, date_inactive, username, password)
		VALUES
		('".$fname."','".$lname."','".$email_adr."','".$contact."','".$user_group."','".$date_added."',
		'".$date_active."','".$date_inactive."','".$username."','".$password."')";
		
		if (!mysql_query($sql,$con))
		{
		  die('Error: ' . mysql_error());
		}
		echo "record added";
		
		header("Location:manage_users.php");

?>	
