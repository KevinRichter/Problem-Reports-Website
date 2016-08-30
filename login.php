<?php 
	session_start();
	
	include_once('connect_mysql.php');
	
	// Clear error messages
	$_SESSION['loginErrorMsg'] = "";
	$_SESSION['already_login_error'] = "";
	$_SESSION['pass'] = "";
	$_SESSION['pass1'] = "";
			
	if ($_SESSION['YOU_ARE_LOGGED_IN'])
	{
		$_SESSION['loginErrorMsg'] = "";
		$_SESSION['already_login_error'] = "You are already logged in, have a nice day ".$_SESSION['fname']."!";
		header("Location:login_screen.php");
		return;
	}
	else
	{	
		$username = trim(mysql_real_escape_string($_POST['username']));
		$_SESSION['already_login_error'] = "";	
		$password = mysql_real_escape_string($_POST['password']);
		$result = mysql_query("SELECT * FROM user_info WHERE username='".$username."'");
		$pass = mysql_result($result, 0, 9);
		if (($password == $pass) && ($password != ""))
		{
			$_SESSION['YOU_ARE_LOGGED_IN'] = true;
			$_SESSION['username'] = $username;
			$_SESSION['fname'] = mysql_result($result, 0, 0);
			$_SESSION['lname'] = mysql_result($result, 0, 1);
			$_SESSION['email_adr'] = mysql_result($result, 0, 2);
			$contact = mysql_result($result, 0, 3);
			$_SESSION['contact'] = preg_replace ("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $contact);
			$_SESSION['user_group'] = mysql_result($result, 0, 4);
			mysql_free_result($result);
			header("Location:index.html");
			if ($_SESSION['user_group'] != 'student' && $_SESSION['user_group'] != 'faculty')
				header("Location:search.php");
		}
		else
		{
			$_SESSION['YOU_ARE_LOGGED_IN'] = false;
			$_SESSION['loginErrorMsg'] = "Your username and/or password did not match";
			mysql_free_result($result);
			header("Location:login_screen.php");	
		}
	}		
?>