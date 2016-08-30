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
	include_once('connect_mysql.php');
	
	if (!$_SESSION['YOU_ARE_LOGGED_IN']) header("Location:login_screen.php");
	$username = $_SESSION['username'];
	$result = mysql_query("SELECT * FROM user_info WHERE username='".$username."'");
	$fields = mysql_num_fields($result);
	$row = mysql_fetch_row($result);
	for ($i = 0;  $i < $fields; $i++) {
		if ($row[$i] == 1)
		$array[$i] = "checked";
	}	
			
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
<link rel="stylesheet" href="../css/private.css" type="text/css" media="screen" charset="utf-8"/>
<!-- TemplateBeginEditable name="doctitle" -->
<title>New Account</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
<style type="text/css">
.auto-style1 {
	font-size: x-large;
}
.auto-style2 {
	font-size: large;
	text-decoration: underline;
}
.auto-style3 {
	font-size: small;
}
.auto-style4 {
	font-family: Verdana;
}
.auto-style5 {
	font-size: xx-small;
	color: #00573D;
}
</style>
 

</head>
<body>

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
            <!--<ul class="horiz_menu">
				<li><a href="#">Sister Dept 1</a></li>
				<li><a href="#">Sister Dept 2</a></li>
				<li><a href="#">Sister Dept 3</a></li>
				<li><a href="#">Sister Dept 4</a></li>
				<li><a href="#">Sister Dept 5</a></li>
				<li class="last"><a href="#">Sister Dept 6</a></li>
			</ul>-->
 
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
					<font color="black" size="2"><?php if ($_SESSION['username'])echo "Welcome ".$_SESSION['username']."!"; ?></font></span></strong>
					<!-- Begin Main Content -->
					<!-- TemplateBeginEditable name="MainContent" -->
					<!-- TemplateEndEditable -->
					<!-- End Main Content -->
					<!--    -->
					<div style="clear:both;"><br />
						<br />
						<span class="auto-style2">User Preferences<br />
						</span><font color="red"><?php echo $_SESSION['emptyError']; echo "\n\n";?></font> <br />
						<br />
						<form action="update_preferences.php" method="post" name="newUserForm">
							Select the columns you want for your report list<span class="auto-style3"><br />
							<br />
							<br />
							</span>
							<span class="auto-style4"><span class="auto-style5">
							(Always Checked)</span></span><span class="auto-style3"><br />								
							Report ID&nbsp;<input name="Checkbox1" type="checkbox" value="1" <?php echo $array[10]; ?> />&nbsp;&nbsp;&nbsp;&nbsp;
							Subject&nbsp;<input name="Checkbox2" type="checkbox" value="1" <?php echo $array[11]; ?>/>&nbsp;&nbsp;&nbsp; 							
							Description&nbsp;<input name="Checkbox3" type="checkbox" value="1" <?php echo $array[12]; ?>/>&nbsp;&nbsp;&nbsp; 
							
							Category&nbsp;<input name="Checkbox4" type="checkbox" value="1" <?php echo $array[13]; ?> />&nbsp;&nbsp;&nbsp; 
							
							Due Date&nbsp;<input name="Checkbox5" type="checkbox" value="1" <?php echo $array[14]; ?>/>&nbsp;&nbsp;&nbsp; 
							
							System Type&nbsp;<input name="Checkbox6" type="checkbox" value="1" <?php echo $array[15]; ?>/><br />
							<br />
							
							Problem Type&nbsp;<input name="Checkbox7" type="checkbox" value="1" <?php echo $array[16]; ?>/>&nbsp;&nbsp;&nbsp; 
							
							Building&nbsp;<input name="Checkbox8" type="checkbox" value="1" <?php echo $array[17]; ?>/>&nbsp;&nbsp;&nbsp; 
							
							Room&nbsp;<input name="Checkbox9" type="checkbox" value="1" <?php echo $array[18]; ?>/>&nbsp;&nbsp;&nbsp;
							Placement In Room&nbsp;
							<input name="Checkbox10" type="checkbox" value="1" <?php echo $array[19]; ?>/>&nbsp;&nbsp;&nbsp; 
							Time Spent&nbsp;
							<input name="Checkbox11" type="checkbox" value="1" <?php echo $array[20]; ?>/>&nbsp;&nbsp;&nbsp; 
							Priority&nbsp;
							<input name="Checkbox12" type="checkbox" value="1" <?php echo $array[21]; ?>/><br />
							<br />
							<span>Escalation&nbsp;
							<input name="Checkbox13" type="checkbox" value="1" <?php echo $array[22]; ?>/>&nbsp;&nbsp;&nbsp; 
							Reporter Name&nbsp;
							<input name="Checkbox14" type="checkbox" value="1" <?php echo $array[23]; ?>/>&nbsp;&nbsp;&nbsp; 
							Reporter Email&nbsp;
							<input name="Checkbox15" type="checkbox" value="1" <?php echo $array[24]; ?>/>&nbsp;&nbsp;&nbsp; 
							Reporter Phone&nbsp;
							<input name="Checkbox16" type="checkbox" value="1" <?php echo $array[25]; ?>/>&nbsp;&nbsp;&nbsp; 
							Status&nbsp;
							<input name="Checkbox17" type="checkbox" value="1" <?php echo $array[26]; ?>/><br />
							<br />
							Date Entered&nbsp;
							<input name="Checkbox18" type="checkbox" value="1" <?php echo $array[27]; ?>/>&nbsp;&nbsp;&nbsp; 
							Date Completed&nbsp;
							<input name="Checkbox19" type="checkbox" value="1" <?php echo $array[28]; ?>/>&nbsp;&nbsp;&nbsp; 
							Resolution&nbsp;
							<input name="Checkbox20" type="checkbox" value="1" <?php echo $array[29]; ?>/>&nbsp;&nbsp;&nbsp; 
							Computer Name&nbsp;
							<input name="Checkbox21" type="checkbox" value="1" <?php echo $array[30]; ?>/>&nbsp;&nbsp;&nbsp; 
							Completed By&nbsp;
							<input name="Checkbox22" type="checkbox" value="1" <?php echo $array[31]; ?>/><br />
							</span><br />		
												
							<br />
							<br />
							<input name="Submit1" type="submit" value="Update" />
							<br />
							<br />
						</form>
					</div>
				</div>
			</div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="logout.php">Logout</a></div>
		<div class="footer" style="clear:both;">
			<p>California State University, Sacramento | 6000 J Street | Sacramento, CA 95819 | (916) 278-6011 </p>
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
							</span>
</body>
</html>
