<?php 
		session_start();
		$_SESSION['subject'] = "";
		$_SESSION['description'] = "";
		$_SESSION['category'] = "Select a Category";
		
		// Set default date to 10 days in the future
		$due_date = strtotime("+ 1 week 3 days");
		$month = date('M', $due_date);
		$day = date('d', $due_date);
		$year = date('Y', $due_date);

		$_SESSION['month_due'] = $month;
		$_SESSION['day_due'] = $day;
		$_SESSION['year_due'] =	$year;
		$_SESSION['system_type'] = "Select a System Type";
		$_SESSION['room_building'] = "";
		$_SESSION['room_number'] =	"";
		$_SESSION['comp_name'] = "";
		$_SESSION['prob_type'] = "lab";
		$_SESSION['pos_room'] =	"";
		$_SESSION['hours'] = 0;
		$_SESSION['priority'] =	"low";
		$_SESSION['escalation'] = "Labbie";
		$_SESSION['id'] = NULL;


	header("Location:new_problem.php");
?>
