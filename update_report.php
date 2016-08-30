<?php

		session_start();
		include_once('connect_mysql.php');
		$report_id = $_SESSION['update_id'];
		
		// Clear any error messages
		$_SESSION['idError'] = "";
		$_SESSION['missingInfo1'] = "";
		$_SESSION['missingInfo2'] = "";
		$_SESSION['missingInfo3'] = "";
		$_SESSION['missingInfo4'] = "";
		$_SESSION['missingInfo5'] = "";
		
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
		
		if (!$subject || !$prob_desc ||  !$room_building || !$room_number || !$category)
		{	
			if (!$subject) $_SESSION['missingInfo1'] = "Enter a subject!";
			if (!$prob_desc) $_SESSION['missingInfo2'] = "Enter a description!";
			if (!$category) $_SESSION['missingInfo3'] = "Enter a category!";
			if (!$room_building) $_SESSION['missingInfo4'] = "Enter a building!";
			if (!$Room_number) $_SESSION['missingInfo5'] = "Enter a room number!";
			header("Location: internal_view.php?ID=$report_id");
			return;
		}	

		
		mysql_query("UPDATE p_report SET subject='".$subject."', prob_desc = '".$prob_desc."', category = '".$category."', priority = '".$priority."',".
					"escalation = '".$escalation."', date_complete = '".$date_complete."', hours = '".$hours."', system_type = '".$system_type."',".
					"room_building = '".$room_building."', room_number = '".$room_number."', position_room = '".$pos_room."', problem_type = '".$prob_type."', computer_name = '".$comp_name."',".
					"reporter_name = '".$reporter_name."', reporter_email = '".$email_adr."', reporter_phone = '".$contact."', prob_resolution = '".$prob_resolution."', status = '".$status."',".
					"completed_by = '".$completed_by."', month_due = '".$month_due."', day_due = '".$day_due."', year_due = '".$year_due."' where ID = '".$report_id."'") or die(mysql_error().mysql_errno());
					
		header("Location:internal_view.php?ID=$report_id");
		
?>
			
