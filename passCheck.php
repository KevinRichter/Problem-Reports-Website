<?php
  session_start();

/******************************************************************
* File name:   passCheck.php
*
* Description: This is a username and password checking page.  If the
* 	       user enters a correct username and password then they
* 	       are logged into the Brown Bag Application
*	       	 otherwise they are redirected back to the login page.
*					 For a username and password to be correct they either must
*					 belong to the appropriate unix group or their username
*					 must be on the admin username list.
******************************************************************/

	
 
  	 $login_page_live = "https://gaia.ecs.csus.edu/~lynne/pass-test/login.php";
    // Squirrelmail Redirect Link
  	 $sqMailRedirect_live = "https://gaia.ecs.csus.edu/~lynne/pass-test/login.php";
  /************/


  
  			$login_page = $login_page_live;
  			$sqMailRedirect = $sqMailRedirect_live;
	
	if( ($_POST[check_input] != " " && $_POST[username] != " " && $_POST[password] != " ") ||
			(isset($_COOKIE[username]) && isset($_COOKIE[portalkey]) ))
  {

			$username = $_POST[username];
			$password = $_POST[password];

			//Is the username in the unix database of usernames
			$crypted = posix_getpwnam( $username );
    	if(! is_array($crypted) )
    	{
      	$_SESSION[loginError] = "You did not enter a correct username.";
      	header("Location: ".$login_page);
      	return;
    	}
			//Does the password match the one in the unix database
    	$pass = $crypted['passwd'];
			if( crypt( $password, $pass ) != $pass )
    	{
      	# Invalid password
      	$_SESSION[loginError] = "The password you entered was not correct.";
      	header("Location: ".$login_page);
				return;
    	}

	// Retrieve Full Name
	$_SESSION['GID']=$crypted['gid'];
        $fullname = $crypted['gecos'];
        $tempname=$fullname;
        $tempname=substr($fullname, 0, strpos($fullname, ','));
        if ($tempname!=null)
        {
        $fullname=$tempname;
        }
        $_SESSION[FULLNAME]= $fullname;


		/* At this point the user has an approved unix login so
		 * we now set all of the other session variables for each
		 * application that is part of the ECS portal.
		 */
		setcookie('AC_PORTAL', true, 0, '/', '.ecs.csus.edu', 0);

// YOUR SITE
		$acgroup = substr( current(posix_getgrgid($crypted['gid'])), 0, 3);
		$acgroupFound = false;

	 	// Is the user part of one of the approved groups
 		// std = student, stf = staff, fac = faculty, oth = other (part-time faculty)
		if( strcmp($acgroup, 'std')==0 ||
				strcmp($acgroup, 'stf')==0 ||
				strcmp($acgroup, 'fac')==0 ||
				strcmp($acgroup, 'oth')==0)
		{
			//echo "Found Group";
			$acgroupFound = true;
		}
	
		// specific approved users
		if($acgroupFound || $username =="helpdesk" || $username =="systemsupport" )
	{
    	$_SESSION[YOUR_WEB_LOGIN] = "true";

	}
		header("Location: ".$sqMailRedirect);

	}
?>
