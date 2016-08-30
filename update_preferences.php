<?php 
		session_start();
		include_once('connect_mysql.php');
		if (!$_SESSION['YOU_ARE_LOGGED_IN']) header("Location:login_screen.php");
		if (trim($_SESSION['user_group']) == "student" || $_SESSION['user_group'] == "faculty") 
		header("Location:oops.php");
		
		$username = mysql_real_escape_string($_SESSION['username']);
		
		$sql = mysql_query("UPDATE user_info SET Subject = '".(int)$_POST['Checkbox2']."', Description = '".(int)$_POST['Checkbox3']."',".
		 				  "Category='".$_POST['Checkbox4']."', Due_Date='".$_POST['Checkbox5']."', System_Type='".$_POST['Checkbox6']."', Problem_Type='".$_POST['Checkbox7']."',".
					      "Building='".$_POST['Checkbox8']."', Room='".$_POST['Checkbox9']."', Placement_In_Room='".$_POST['Checkbox10']."', Time_Spent='".$_POST['Checkbox11']."',".  
		 				  "Priority='".$_POST['Checkbox12']."', Escalation='".$_POST['Checkbox13']."', Reporter_Name='".$_POST['Checkbox14']."', Reporter_Email='".$_POST['Checkbox15']."',".
		 				  "Reporter_Phone='".$_POST['Checkbox16']."', Status='".$_POST['Checkbox17']."', Date_Entered='".$_POST['Checkbox18']."', Date_Completed='".$_POST['Checkbox19']."',".
		 				  "Resolution='".$_POST['Checkbox20']."', Computer_Name='".$_POST['Checkbox21']."', Completed_By='".$_POST['Checkbox22']."' where username = '".$username."'") or die(mysql_error().mysql_errno());
		 
		 
					
					
		
		header("Location:user_preferences.php");		
		
?>		