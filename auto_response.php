<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- 
Sac State Template
2009-09-16
2.0.171
 -->
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
<title>Sac State</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
<style type="text/css">
.auto-style1 {
	font-size: x-large;
}
</style>
</head>
<body>
<?php
	session_start();
	
	$reporter = $_SESSION['fname'];
	$subject = $_SESSION['subject'];
	$id = $_SESSION['id'];
	$date_submitted = $_SESSION['date_submitted'];
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
				<div class="wrapper" style="height: 225px"><strong><span class="auto-style1">Problem 
					Reports Center</span></strong>
					<!-- Begin Main Content -->
					<!-- TemplateBeginEditable name="MainContent" -->
					<!-- TemplateEndEditable -->
					<!-- End Main Content -->
					<!--    -->
					<p>Hello <?php echo "$reporter"; ?>, </p>
					<p>The problem report, <?php echo "$subject";?> with ID number <?php echo $id;?> 
					has been added to the list of current problems, and if an 
					email address was provided, a confirmation email has been 
					sent out.&nbsp; </p>
					<p>The problem was submitted on <?php echo date("m-d-Y");?>.&nbsp; If 
					you would like to check the status at any time you can go to</p>
					<p>
					<a href="http://www.ecs.csus.edu/webApps/p_report/search.php">
					www.ecs.csus.edu/webApps/p_report/search.php</a></p>
					<p>If you have any questions, please contact ECS Computing 
					Services at</p>
					<p><a href="mailto:support@ecs.csus.edu">
					support@ecs.csus.edu</a></p>
					<p><a href="http://www.ecs.csus.edu/">ECS Home </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="http://www.csus.edu/">CSUS Home</a></p>
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
