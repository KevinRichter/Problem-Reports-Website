<?php

/* CLASS: Library()
 * DESCRIPTION: This class will be used for defining any library functions for the site.
 */
class Library {
function logout()
{
        session_destroy();
}

 function checkLoginStatus()
  {
     session_start();
     
		// Check if application specific session variable is set
		 if($_SESSION[YOUR_WEB_LOGIN] != "true")
     {
				// Session variable not set, go to login page
       
       header("Location: https://gaia.ecs.csus.edu/~lynne/pass-test/login.php");
     }
  }
  
// end of class
}
?>
