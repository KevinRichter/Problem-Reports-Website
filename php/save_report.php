<html>

<head>
<title>Save Report</title>
</head>

<body>
<h1>Testing Submit</h1>

	<?php 
		echo "TESTER";
		$dbhost = "athena.ecs.csus.edu";
		$dbuser = "recursion";
		$dbpass = "recursion_db";
		$dbname = "recursion";
		$con = mysql_connect("$dbhost","$dbuser","$dbpass") or die(mysql_error());	
		mysql_select_db("$dbname") or die("no database by that name");
		
		echo "<br /><h2>You are successfully connected to your database.</h2><br /><br />
			Otherwise you would see an include warning, or a mysql connection error.<br /><br />
			Happy coding!
			";
	
		$subject = $_POST['Subject'];
		$prob_desc = $_POST['Description'];
		$category = $_POST['Category'];
		$date_due = $_POST['Month']."/".$_POST['Day']."/".$_POST['Year'];
		$system_type = $_POST['System_type'];
		$location = $_POST['Building']." ".$_POST['Room_number'];
		

		$sql="INSERT INTO p_reports (subject, prob_desc, category, date_due, system_type, location)
		VALUES
		($subject,$prob_desc,$category,$date_due,$system_type,$location)";
		
		if (!mysql_query($sql,$con))
		  {
		  die('Error: ' . mysql_error());
		  }
		echo "1 record added";
				
	
	?>
</body>

</html>
