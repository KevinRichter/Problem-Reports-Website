<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- 
Sac State Template
2009-09-16
2.0.171
 -->
<?php 
	// To allow session data to prepopulate form if it exists.
	session_start();
		
	if (!$_SESSION['YOU_ARE_LOGGED_IN']) header("Location:login_screen.php");
?> 

<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="http://www.csus.edu/webpages/reset-min.css" type="text/css" media="screen" charset="UTF-8" />
<link rel="stylesheet" href="http://www.csus.edu/webpages/template_seafoam2/css/print.css" type="text/css" media="print" charset="utf-8"/>
<link rel="stylesheet" href="http://www.csus.edu/webpages/template_seafoam2/css/seafoam2.css" type="text/css" media="screen" title="Seafoam look and feel" charset="utf-8"/>
<script type="text/javascript" src="http://www.csus.edu/webpages/scripts/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="http://www.csus.edu/webpages/scripts/superfish.js"></script>
<script type="text/javascript" src="../js/private.js"></script>
<script type="text/javascript" src="jquery-latest.js"></script> 
<script type="text/javascript" src="jquery.tablesorter.js"></script> 
<link rel="stylesheet" href="../css/private.css" type="text/css" media="screen" charset="utf-8"/>
<!-- TemplateBeginEditable name="doctitle" -->
<title>Sac State</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
<style type="text/css">
.auto-style1 {
	font-size: x-large;
}
.auto-style2 {
	font-size: large;
}
.auto-style3 {
	font-size: medium;
}
.auto-style4 {
	text-decoration: underline;
}
.auto-style5 {
	border-style: solid;
	border-width: 1px;
	text-align: left;
}
</style>

<script type="text/javascript">
$(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 
    } 
); 
</script>
</head>
<body>

<?php
	session_start();
		
		function makeTable() {
		// Make a MySQL Connection
	
		// Place db host name. Usually is "localhost" but sometimes a more direct string is needed
		$db_host = "athena.ecs.csus.edu";
		// Place the username for the MySQL database here
		$db_username = "recursion"; 
		// Place the password for the MySQL database here
		$db_pass = "recursion_db";
		// Place the name for the MySQL database here
		$db_name = "recursion";
		
		mysql_connect("$db_host","$db_username","$db_pass") or die(mysql_error());
		mysql_select_db("$db_name") or die("no database by that name");	
		
		$searchName = $_POST['searchName'];
				 
		 // sorting order
		 $order = trim($_GET['sort']);
		 if ($order == "DESC") { $order = "ASC"; }
		 else { $order = "DESC"; }
		 $col = $_GET['col'];
		 if (!$col) $col = 'ID';
		 			 
		 //get preferences of internal users
		 $user_pref = mysql_query("SELECT * FROM user_info WHERE username='".mysql_real_escape_string($_SESSION['username'])."'") or die(mysql_error());
		 

		
		

		$fieldNameArray[0] = "ID";
		$fieldNameArray[1] = "subject";
		$fieldNameArray[2] = "prob_desc";
		$fieldNameArray[3] = "category";
		$fieldNameArray[4] = "month_due";
		$fieldNameArray[5] = "system_type";
		$fieldNameArray[6] = "problem_type";
		$fieldNameArray[7] = "room_building";
		$fieldNameArray[8] = "room_number";
		$fieldNameArray[9] = "position_room";
		$fieldNameArray[10] = "hours";
		$fieldNameArray[11] = "priority";
		$fieldNameArray[12] = "escalation";
		$fieldNameArray[13] = "reporter_name";
		$fieldNameArray[14] = "reporter_email";
		$fieldNameArray[15] = "reporter_phone";
		$fieldNameArray[16] = "status";
		$fieldNameArray[17] = "date_entered";
		$fieldNameArray[18] = "date_complete";
		$fieldNameArray[19] = "prob_resolution";
		$fieldNameArray[20] = "computer_name";
		$fieldNameArray[21] = "completed_by";

		if ($_SESSION['user_group'] == 'student' || $_SESSION['user_group'] == 'faculty') {
			$pref[0] = 1;
			$pref[1] = 1;
			$pref[3] = 1;
			$pref[13] = 1;
			$pref[16] = 1;
			$pref[17] = 1;
			$pref[21] = 1;

			$fieldarray = array("ID", "subject", "category", "reporter_name", "status", "date_entered", "completed_by");
		}	
		// internal user preference loading
		else {
			$pref_arr = mysql_fetch_row($user_pref);
			$count = 0;
			for ($i = 10; $i < mysql_num_fields($user_pref); $i++) {
				if ($pref_arr[$i] == 1) { 
					$pref[$i-10] = 1;
					$fieldarray[$count] = $fieldNameArray[$i-10];
					$count++;
				}
			}

		}


		$fieldCount = count($fieldarray);	

 		echo '<table id="myTable" class="tablesorter" border="1" cellpadding="2" cellspacing="0">';
		echo '<thead>';
		echo "<tr bgcolor='#CCCCCC'>";
		if ($pref[0] == 1) echo "<td><h1><b><center><a href=\"search.php?sort=$order & col=ID\">Report ID</a></b></center></h1></td>";
		if ($pref[1] == 1) echo "<td><h1><b><center><a href=\"search.php?sort=$order & col=subject\">Subject</a></b></center></h1></td>";
		if ($pref[2] == 1) echo "<td><h1><b><center><a href=\"search.php?sort=$order & col=prob_desc\">Description</a></b></center></h1></td>";
		if ($pref[3] == 1) echo "<td><h1><b><center><a href=\"search.php?sort=$order & col=category\">Category</a></b></center></h1></td>";
		if ($pref[4] == 1) echo "<td><h1><b><center><a href=\"search.php?sort=$order & col=month_due\">Due Date</a></b></center></h1></td>";
		if ($pref[5] == 1) echo "<td><h1><b><center><a href=\"search.php?sort=$order & col=system_type\">System Type</a></b></center></h1></td>";
		if ($pref[6] == 1) echo "<td><h1><b><center><a href=\"search.php?sort=$order & col=problem_type\">Problem Type</a></b></center></h1></td>";
		if ($pref[7] == 1) echo "<td><h1><b><center><a href=\"search.php?sort=$order & col=room_building\">Building</a></b></center></h1></td>";
		if ($pref[8] == 1) echo "<td><h1><b><center><a href=\"homsearch.php?sort=$order & col=room_number\">Room</a></b></center></h1></td>";
		if ($pref[9] == 1) echo "<td><h1><b><center><a href=\"search.php?sort=$order & col=position_room\">Placement In Room</a></b></center></h1></td>";
		if ($pref[10] == 1) echo "<td><h1><b><center><a href=\"search.php?sort=$order & col=hours\">Time Spent</a></b></center></h1></td>";
		if ($pref[11] == 1) echo "<td><h1><b><center><a href=\"search.php?sort=$order & col=priority\">Priority</a></b></center></h1></td>";
		if ($pref[12] == 1) echo "<td><h1><b><center><a href=\"search.php?sort=$order & col=escalation\">Escalation</a></b></center></h1></td>";
		if ($pref[13] == 1) echo "<td><h1><b><center><a href=\"search.php?sort=$order & col=reporter_name\">Reporter Name</a></b></center></h1></td>";
		if ($pref[14] == 1) echo "<td><h1><b><center><a href=\"search.php?sort=$order & col=reporter_email\">Reporter Email</a></b></center></h1></td>";
		if ($pref[15] == 1) echo "<td><h1><b><center><a href=\"search.php?sort=$order & col=reporter_phone\">Reporter Phone</a></b></center></h1></td>";
		if ($pref[16] == 1) echo "<td><h1><b><center><a href=\"search.php?sort=$order & col=status\">Status</a></b></center></h1></td>";
		if ($pref[17] == 1) echo "<td><h1><b><center><a href=\"search.php?sort=$order & col=date_entered\">Date Entered</a></b></center></h1></td>";
		if ($pref[18] == 1) echo "<td><h1><b><center><a href=\"search.php?sort=$order & col=date_complete\">Date Completed</a></b></center></h1></td>";
		if ($pref[19] == 1) echo "<td><h1><b><center><a href=\"search.php?sort=$order & col=prob_resolution\">Resolution</a></b></center></h1></td>";
		if ($pref[20] == 1) echo "<td><h1><b><center><a href=\"search.php?sort=$order & col=computer_name\">Computer Name</a></b></center></h1></td>";
		if ($pref[21] == 1) echo "<td><h1><b><center><a href=\"search.php?sort=$order & col=completed_by\">Completed By</a></b></center></h1></td>";
		echo "</tr>";
		echo '</thead>';
		echo '<tbody>';
		$color = 1;	

		for($x = 0; $x < $fieldCount; $x++) {

			 // external user query and set default preferences
			 if ($_SESSION['user_group'] == 'student' || $_SESSION['user_group'] == 'faculty') {
					
			 	$result = mysql_query("SELECT * FROM p_report WHERE user_name='".mysql_real_escape_string($_SESSION['username'])."' AND $fieldarray[$x] LIKE '%$searchName%' ORDER BY ".$col." ".$order."") or die(mysql_error()) ;
				if($searchName = ""){				
					$x = $fieldCount;
				}
				$x = $fieldCount;
			 }	
			 // inLIKE '%$searchName%'ternal user preference loading
			 else {
			 	$result = mysql_query("SELECT * FROM p_report WHERE $fieldarray[$x] LIKE '%$searchName%' ORDER BY ".$col." ".$order." ") or die(mysql_error());
			 }
			 $itemnum = mysql_num_rows($result);
			
			 
			     if ($itemnum > 0) {
				while($items = mysql_fetch_row($result)){ 
				    	
					if ($color == 1) {
						echo "<tr bgcolor='#c6d6ce'>" ;
						$report_id = $items[0];
						echo "<td><a href=\"view_report.php?ID=$report_id\">".$report_id."</a></td>";
						 if ($pref[1] == 1) echo "<td>".$items[1]."</td>";
			 			 if ($pref[2] == 1) echo "<td>".$items[2]."</td>";
						 if ($pref[3] == 1) echo "<td>".$items[3]."</td>";
						 if ($pref[4] == 1) echo "<td>".$items[24]."-".$items[25]."-".$items[26]."</td>";
						 if ($pref[5] == 1) echo "<td>".$items[9]."</td>";
						 if ($pref[6] == 1) echo "<td>".$items[13]."</td>";
						 if ($pref[7] == 1) echo "<td>".$items[10]."</td>";
						 if ($pref[8] == 1) echo "<td>".$items[11]."</td>";
						 if ($pref[9] == 1) echo "<td>".$items[12]."</td>";
						 if ($pref[10] == 1) echo "<td>".$items[8]."</td>";
						 if ($pref[11] == 1) echo "<td>".$items[4]."</td>";
						 if ($pref[12] == 1) echo "<td>".$items[5]."</td>";
					 if ($pref[13] == 1) echo "<td>".$items[15]."</td>";
					 if ($pref[14] == 1) echo "<td>".$items[16]."</td>";
					 if ($pref[15] == 1) echo "<td>".$items[17]."</td>";
					 if ($pref[16] == 1) echo "<td>".$items[19]."</td>";
						 if ($pref[17] == 1) echo "<td>".$items[6]."</td>";
					 if ($pref[18] == 1) echo "<td>".$items[7]."</td>";
					 if ($pref[19] == 1) echo "<td>".$items[18]."</td>";
					 if ($pref[20] == 1) echo "<td>".$items[14]."</td>";
						 if ($pref[21] == 1) echo "<td>".$items[20]."</td>";
	 		
						$color = 2;
						echo "</tr>" ;
					} else {
						echo "<tr bgcolor='#CCCCCC'>" ;
						$report_id = $items[0];
						echo "<td><a href=\"view_report.php?ID=$report_id\">".$report_id."</a></td>";
					
						 if ($pref[1] == 1) echo "<td>".$items[1]."</td>";
			 			 if ($pref[2] == 1) echo "<td>".$items[2]."</td>";
						 if ($pref[3] == 1) echo "<td>".$items[3]."</td>";
						 if ($pref[4] == 1) echo "<td>".$items[24]."-".$items[25]."-".$items[26]."</td>";
						 if ($pref[5] == 1) echo "<td>".$items[9]."</td>";
						 if ($pref[6] == 1) echo "<td>".$items[13]."</td>";
						 if ($pref[7] == 1) echo "<td>".$items[10]."</td>";
						 if ($pref[8] == 1) echo "<td>".$items[11]."</td>";
						 if ($pref[9] == 1) echo "<td>".$items[12]."</td>";
						 if ($pref[10] == 1) echo "<td>".$items[8]."</td>";
						 if ($pref[11] == 1) echo "<td>".$items[4]."</td>";
						 if ($pref[12] == 1) echo "<td>".$items[5]."</td>";
					 if ($pref[13] == 1) echo "<td>".$items[15]."</td>";
					 if ($pref[14] == 1) echo "<td>".$items[16]."</td>";
					 if ($pref[15] == 1) echo "<td>".$items[17]."</td>";
					 if ($pref[16] == 1) echo "<td>".$items[19]."</td>";
						 if ($pref[17] == 1) echo "<td>".$items[6]."</td>";
					 if ($pref[18] == 1) echo "<td>".$items[7]."</td>";
					 if ($pref[19] == 1) echo "<td>".$items[18]."</td>";
					 if ($pref[20] == 1) echo "<td>".$items[14]."</td>";
						 if ($pref[21] == 1) echo "<td>".$items[20]."</td>";
						$color = 1;
						echo "</tr>" ;
					}
				
				     }	
				
			 }
		}
		 echo '</tbody>';
		 echo '</table>';
	}
?>

<p><a href="#content" class="hide_focus">Skip to Content</a></p>
<div class="topshadow"></div>
<div class="shadowcontainer">
	<div class="maincontainer container_16">
		<div class="header"> <a class="block float_left" href="http://www.csus.edu"> 
			<img src="csus_ecs_logo.jpg" alt="Sacramento State" height="74" width="500"/> </a>
			<div class="search float_right">
				<form id="search" method="get" action="http://google.calstate.edu/search">
					<p>
						<label for="searchbox">Search</label>
						<input id="searchbox" type="text" size="15" maxlength="256" name="q"/>
						<input id="gobutton" type="image" title="go" alt="go" src="http://www.csus.edu/webpages/homepage/sacstate-images/gobutton.png"/>
						<input type="hidden" value="p" name="access"/>
						<input type="hidden" value="csus" name="site"/>
						<input type="hidden" value="xml_no_dtd" name="output"/>
						<input type="hidden" value="csus-edu" name="client"/>
						<input type="hidden" value="date:D:L:d1" name="sort"/>
						<input type="hidden" value="csus-edu" name="proxystylesheet"/>
						<input type="hidden" value="UTF-8" name="oe"/>
						<!--This line makes the search specific to the url in the "value", below -->
						<!-- <input type="hidden" value="inurl:www.csus.edu/your_dept" name="hq" /> -->
					</p>
				</form>
			</div>
			<ul class="green_bg horizontal global menu ">
				<li id="global_home"><a href="http://www.csus.edu/">sac state home</a></li>
				<li id="global_admissions"><a href="http://www.csus.edu/admissions/">admissions</a></li>
				<li id="global_about"><a href="http://www.csus.edu/webpages/about.stm">about sac state</a></li>
				<li id="global_give"><a href="http://www.csus.edu/giving/">giving a gift</a></li>
				<li id="global_index"><a href="http://www.csus.edu/webpages/siteindex.stm">site index</a></li>
				<li id="global_contact"><a href="http://www.csus.edu/webpages/contactus.stm">contact sac state</a></li>
			</ul>
            <!-- HorizontalMenu -->
            <?php 
            	            	
            	if (trim($_SESSION['user_group']) != "student" && $_SESSION['user_group'] != "faculty") {
	            echo '<ul class="horiz_menu">
					<li><a href="internal_problem.php">Create Report</a></li>
					<li><a href="search.php">Search Reports</a></li>
					<li><a href="user_preferences.php">Preferences</a></li>';
					if (trim($_SESSION['user_group']) == "admin") {
						echo '<li><a href="manage_users.php">Manage Users</a></li>	
						      </ul>';  }
					else
						echo '</ul>';	      
				}	
				
 			?>
			<!-- The banner image for the site -->
			<div class="banner"> <img src="banner_ecs.png" alt="" width="960"/> </div>
		</div>
        	
		<div class="double_dotted_line"></div>
		<div class="page_body left_3cols">
			<div class="navigation grid_3">
				<div class="wrapper">
					<h1 class="hidden">Site Navigation</h1>
					<!-- Begin Navigation -->
					<h2>
					<a href="ecs.csus.edu" style="left: -25px; right: 195px; top: -301px; bottom: 319px">
					</a><a href="http://www.ecs.csus.edu" style="left: 0; right: 0; top: 0; bottom: 0">ECS Home</a></h2>
					<h3><a href="index.html">Problem Reports Home</a></h3>
					
					<!-- End Navigation -->
					<div class="clear"></div>
				</div>
			</div>
			<div id="main_content" class="fancy_border bordered_sidebars grid_13 omega">
				<div class="wrapper"><strong><span class="auto-style1">Problem 
					Reports Center&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="black" size="2"><?php if ($_SESSION['username']) echo "Welcome ".$_SESSION['username']."!"; ?></font><br /></span></strong>
					&nbsp;<!-- Begin Main Content --><!-- TemplateBeginEditable name="MainContent" --><!-- TemplateEndEditable --><!-- End Main Content --><!--    --><div style="clear:both;"><br />
						<span class="auto-style2"><br />
						<span class="auto-style4">Your Existing Reports</span><br />
						<form action="search.php" method="post">
							<div class="auto-style5">
							</span><span class="auto-style3">
							<!--<br />
							<br />
							Enter value to search for:<br />
							</span><span class="auto-style2"><br />
							<input name="searchValue" type="text" />
								<select name="searchName" style="width: 253px">
								<option selected="selected" value="0">subject</option>
								<option value="1">category</option>
								<option value="2">status</option>
								</select><input name="submit" type="submit" value="Search" /><br /> -->
							<br />
							
							
			
							<?php /*
							// Retrieve all the data from the "example" table
							$result = mysql_query("SELECT * FROM p_report WHERE user_name='".mysql_real_escape_string($_SESSION['username'])."'")
							or die(mysql_error());  
							
							// store the record of the "example" table into $row
							$row = mysql_fetch_array( $result );
							// Print out the contents of the entry 
							
							echo "Subject: ".$row['subject'];
							echo " Category: ".$row['category'];
							*/
							
							/*
							$connection = mysql_connect("$db_host","$db_username","$db_pass") or die(mysql_error());
							mysql_select_db("$db_name",$connection) or die("no database by that name");
							
							/* show tables */
							/*
							$result = mysql_query('SHOW TABLE FROM p_report',$connection) or die('cannot show tables');
							while($tableName = mysql_fetch_row($result)) {
							
								$table = $tableName[0];
							  
								echo '<h3>',$table,'</h3>';
								$result2 = mysql_query('SHOW COLUMNS FROM '.$table) or die('cannot show columns from '.$table);
								if(mysql_num_rows($result2)) {
									echo '<table cellpadding="0" cellspacing="0" class="db-table">';
									echo '<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default<th>Extra</th></tr>';
									while($row2 = mysql_fetch_row($result2)) {
										echo '<tr>';
										foreach($row2 as $key=>$value) {
											echo '<td>',$value,'</td>';
										}
										echo '</tr>';
									}
								echo '</table><br />';
								}
							}*/
							
							/*
							echo "<table>";
							$fieldarray = array("id","subject","category","date_entered");
							
							//count number of columns
							 $columns = count($fieldarray);
							//run the query
							 $result = mysql_query("SELECT * FROM p_report") or die(mysql_error()) ;
							 $itemnum = mysql_num_rows($result);
							 if($itemnum > 0){
								do{  
									echo "<tr>" ;
									for($x = 0; $x < $columns; $x++){
										echo "<td>" .$items[$fieldarray[$x]]. "</td>" ;
									}
									echo "</tr>" ;
								}	while($items = mysql_fetch_assoc($result));
							 }
							 
							echo "</table>"; */ ?>
<form method="post" action="search.php?ID=searchName" id="searchform" >
<input type="text" name='searchName' >
<input type="submit" class="button" value="search" name='submit'/>
</form>							
							<?php
							    

							    makeTable();
								/*echo "<table>";
										$searchval = $_SESSION['username'];
										$searchname = "user_name";
										$fieldarray = array("ID", "subject", "category", "date_entered", "reporter_name", "status", "date_complete", "user_name");
										makeTable($fieldarray, $searchval, $searchname);
								echo "</table>";
*/
	
								/*if(isset($_POST['submit'])) {
									echo "<table>";
										$searchval = $_POST['searchValue'];
										$searchname = $_POST['searchName'];
										$fieldarray = array("subject", "category", "date_entered", "reporter_name", "status", "date_complete");
										makeTable($fieldarray, $searchval, $searchname);
									echo "</table>";
								}*/
							?>

							
								<br />
								<a href="login.php">Login</a> /
								<a href="logout.php">Logout</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
								
							</div>
						</form>
						</span>
					</div>
				</div>
			</div>
			<div style="clear:both;"></div>
		</div>
		<div class="footer" style="clear:both;">
			<p>California State University, Sacramento | 6000 J Street | Sacramento, CA 95819 | (916) 278-6011</p>
			<p>If you have difficulty accessing content on this page, please contact the <a href="mailto:webmaster@csus.edu">webmaster</a>.</p>
		</div>
	</div>
</div>
<div class="bottomshadow"></div>
<script type="text/javascript" src="http://www.google-analytics.com/ga.js"></script>
<script type="text/javascript">
		var pageTracker = _gat._getTracker("UA-798015-1");
		pageTracker._initData();
		pageTracker._trackPageview();
</script>
</body>
</html>
