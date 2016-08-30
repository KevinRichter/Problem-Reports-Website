<html>

<head>
<title>Save Report</title>
</head>

<body>
<h1>Testing Submit</h1>

	<?php 
		session_start();
		include_once('connect_mysql.php');
				
		// Required for Captcha box
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
		

		echo "<br /><h2>You are successfully connected to your database.</h2><br /><br />
			Otherwise you would see an include warning, or a mysql connection error.<br /><br />
			Happy coding!
			";
					
		// Converting all POST data to php variables
		$subject = $_POST['Subject'];				
		$prob_desc = $_POST['Description'];		
		$category = $_POST['Category2'];
		if ($category === NULL || $category == 'Other' || $category == 'Select a Category')
			$category = $_POST['Category'];		
		$month_due = $_POST['Month'];		
		$day_due = $_POST['Day'];		
		$year_due = $_POST['Year'];		
		$system_type = $_POST['System_type2'];
		if ($system_type === NULL || $system_type == 'Other' || $system_type == 'Select a System Type')
			$system_type = $_POST['System_type'];		
		$room_building =$_POST['Building2'];
		if ($room_building === NULL || $room_building == 'Other')
			$room_building = $_POST['Building'];		
		$room_number = $_POST['Room_number'];		
		$comp_name = $_POST['Computer_name'];		
		$prob_type = $_POST['Problem_type'];		
		$pos_room = $_POST['Position_room'];		
		$hours = $_POST['Hours'];		
		// Set default for priority
		if ($_POST['Priority'] == NULL)
			$priority = 'low';
		else
			$priority = $_POST['Priority'];		
		// Set default for escalaton	
		if ($_POST['Escalation'] == NULL)
			$escalation = 'Labbie';
		else
			$escalation = $_POST['Escalation'];	
		$email_adr = $_POST['Email_adr'];
		$fname = $_POST['Fname'];
		$lname = $_POST['Lname'];		
		$contact = preg_replace("/[^0-9]/", "", $_POST['Contact']);
		$status = $_POST['Status'];
		$reporter_name = $_POST['Fullname'];
		$prob_resolution = $_POST['Prob_Resolution'];
		$date_complete = $_POST['Date_Complete'];
		$completed_by = $_POST['Completed_By'];
		
		
	
		// Saving Sesion Data
		$_SESSION['subject'] = $subject;
		$_SESSION['description'] = $prob_desc;
		$_SESSION['category'] =	$category;
		$_SESSION['month_due'] = $month_due;
		$_SESSION['day_due'] = $day_due;
		$_SESSION['year_due'] =	$year_due;
		$_SESSION['system_type'] = $system_type;
		$_SESSION['room_building'] = $room_building;
		$_SESSION['room_number'] =	$room_number;
		$_SESSION['comp_name'] = $comp_name;
		$_SESSION['prob_type'] = $prob_type;
		$_SESSION['pos_room'] =	$pos_room;
		$_SESSION['hours'] = $hours;		
		$_SESSION['priority'] =	$priority;
		$_SESSION['escalation'] = $escalation;
		$_SESSION['email_adr'] = $email_adr;
		$_SESSION['fname'] = $fname;
		$_SESSION['lname'] = $lname;
		$_SESSION['contact'] = $contact;
		$_SESSION['status'] = $status;
		
		
		// create fullname for mysql
		$fullname = $fname.' '.$lname;
		
		// Clear any error messages
		$_SESSION['idError'] = "";
		$_SESSION['missingInfo1'] = "";
		$_SESSION['missingInfo2'] = "";
		$_SESSION['missingInfo3'] = "";
		$_SESSION['missingInfo4'] = "";
		$_SESSION['missingInfo5'] = "";
	

		// Creating a submission date that can be saved to mysql	
		date_default_timezone_set('America/Los_Angeles');	
		$phpdate = strtotime( "now" );
		$date_submitted = date( 'Y-m-d H:i:s', $phpdate );		
		$_SESSION['date_submitted'] = $mysqldate;
		
		// Redirect to new_problem if required fields are not filled in
		if (!$subject || !$prob_desc ||  !$room_building || !$room_number || !$category)
		{	
			if (!$_POST['Subject']) $_SESSION['missingInfo1'] = "Enter a subject!";
			if (!$_POST['Description']) $_SESSION['missingInfo2'] = "Enter a description!";
			if (!$category) $_SESSION['missingInfo3'] = "Enter a category!";
			if (!$room_building) $_SESSION['missingInfo4'] = "Enter a building!";
			if (!$_POST['Room_number']) $_SESSION['missingInfo5'] = "Enter a room number!";
			header("Location: new_problem.php?msg=You did not complete all of the required fields");
			return;
		}	
		
		
		// If session id has already been generated need to clear form to create a new one
		if($_SESSION['id'])
		{
			$_SESSION['idError'] = "Report has already been submitted. Click 'Clear Form' button to create a new report.";
			header("Location: new_problem.php?msg=Report has already been submitted. Click 'Reset' button to create a new report.");
			return;
		}
		
		// Telling mysql what data needs to go in each field of p_report table
		// This is done for a brand new report, not to update
		$sql="INSERT INTO p_report (subject, prob_desc, category, year_due, month_due, day_due, system_type, room_building, room_number, computer_name, problem_type, position_room, priority, date_entered, escalation, hours, reporter_name, reporter_email, reporter_phone, user_name)
		VALUES
		('".$subject."','".$prob_desc."','".$category."','".$year_due."','".$month_due."','".$day_due."',
		'".$system_type."','".$room_building."','".$room_number."','".$comp_name."','".$prob_type."',
		'".$pos_room."','".$priority."','".$date_submitted."','".$escalation."','".$hours."','".$fullname."'
		,'".$email_adr."','".$contact."','".$_SESSION['username']."')";
		
		if (!mysql_query($sql,$con))
		  {
		  die('Error: ' . mysql_error());
		  }
		echo "1 record added";
		
		// Session id only saved after it is created in mysql. 
		$_SESSION['id'] = mysql_insert_id();
		
		
		
		//**********************************************************
		//Email Response System
		//----------------------------------------------------------
		
		//define the receiver of the email
		$to = $email_adr;
		//define the subject of the email
		$email_subject = "Error Ticket: $subject";
		//define the message to be sent. Each line should be separated with \n
		$message = "Hello $fname $lname!\n\nThe following error ticket '$subject' has been submitted on $date_submitted\n\nIf you would like to check the status of this report you can search for it at http://ecs.csus.edu/~recursio/search.php\n".
					"For any questions please email the ECS staff at support@ecs.csus.edu\n\nThank You!";
		//define the headers we want passed. Note that they are separated with \r\n
		$headers = "From: ngniech@gmail.com\r\nReply-To: ngniech@gmail.com";
		//send the email
		$mail_sent = @mail( $to, $email_subject, $message, $headers );
		//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
		echo $mail_sent ? "Mail sent" : "Mail failed";
		
		//**********************************************************
				
		// redirect to auto response page after successfully adding new report
		header("Location:auto_response.php");
				
	
	?>
</body>

</html>
