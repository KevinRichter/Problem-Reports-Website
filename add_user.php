<?php 
// Adds external users only. Will only group them as students


		session_start();
		include_once('connect_mysql.php');
		require_once('recaptchalib.php');
  		$privatekey = "6LcpK9oSAAAAAI_-W0ros2NywzMhL1xQFuOgvJWS";
  		$resp = recaptcha_check_answer ($privatekey,
		                                $_SERVER["REMOTE_ADDR"],
		                                $_POST["recaptcha_challenge_field"],
		                                $_POST["recaptcha_response_field"]);

		if (!$resp->is_valid) {
		    // What happens when the CAPTCHA was entered incorrectly
		    die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
		         "(reCAPTCHA said: " . $resp->error . ")");
		} 



		$fname = mysql_real_escape_string($_POST['fname']);
		$lname = mysql_real_escape_string($_POST['lname']);
		$email_adr = $_POST['email_adr'];
		$contact = preg_replace("/[^0-9]/", "", $_POST['contact']);
		date_default_timezone_set('America/Los_Angeles');
		$date_added = date('Y-m-d');
		$date_active = date('Y-m-d');
		$date_inactive = NULL;
		$username = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string($_POST['password']);
		$password1 = mysql_real_escape_string($_POST['password1']);
		
		// Create session variables in case new_user needs to be reloaded, data will be saved
		$_SESSION['fname'] = $fname;
		$_SESSION['lname'] = $lname;
		$_SESSION['email_adr'] = $email_adr;
		$_SESSION['username'] = $username;
		$_SESSION['contact'] = $contact;
		
		
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
		$sql="INSERT INTO user_info (fname, lname, email_adr, contact, date_added, date_active, date_inactive, username, password)
		VALUES
		('".$fname."','".$lname."','".$email_adr."','".$contact."','".$date_added."',
		'".$date_active."','".$date_inactive."','".$username."','".$password."')";
		
		if (!mysql_query($sql,$con))
		{
		  die('Error: ' . mysql_error());
		}
		echo "record added";
		
		// Destroy these session varaibles after record has been added for security and re-direct to login_screen
		$_SESSION['fname'] = "";
		$_SESSION['lname'] = "";
		$_SESSION['email_adr'] = "";
		$_SESSION['username'] = "";
		$_SESSION['contact'] = "";
		
		header("Location:login_screen.php");


		
?>
		
		
		
		
		
		
		
		
			
			