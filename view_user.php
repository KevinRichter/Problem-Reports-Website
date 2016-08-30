<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- 
Sac State Template
2009-09-16
2.0.171
 -->
<?php 
//  Accessible by Admins only!


		session_start();
		include_once('connect_mysql.php');
		
		if (trim($_SESSION['user_group']) != "admin")
			header("Location:oops.php?msg=You are not an Admin");
			
		$user_id = $_GET['ID'];
		$_SESSION['user_temp'] = $user_id;	
			
		$user = mysql_query("SELECT * FROM user_info WHERE username='".mysql_real_escape_string("$user_id")."'") or die(mysql_error());
	
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
					<li><a href="user_preferences.php">Preferences</a></li>
					<li><a href="manage_users.php">Manage Users</a></li>	
				    </ul>';				
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
					<font color="black" size="2"><?php if ($_SESSION['username'])echo "Welcome ".$_SESSION['username']."!"; ?></font></span></strong>
					<!-- Begin Main Content -->
					<!-- TemplateBeginEditable name="MainContent" -->
					<!-- TemplateEndEditable -->
					<!-- End Main Content -->
					<!--    -->
					<div style="clear:both;"><br />
						<br />
						<span class="auto-style2">Manage Users - Edit User<br />
						</span><font color="red"><?php echo $_SESSION['emptyError']; echo "\n\n";?></font> <br />
						<br />
						<form action="update_user.php" method="post" name="newUserForm">
							<span class="auto-style3"><br />
							First Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input name="fname" style="width: 200px" type="text" value="<?php echo mysql_result($user, 0, 0); ?>"/><br />
							<br />
							Last Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="lname" style="width: 200px" type="text" 
							value="<?php echo mysql_result($user, 0, 1); ?>"/><br />
							</span>
							<br />
							<span class="auto-style3">Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input name="email_adr" style="width: 200px" type="text" value="<?php echo mysql_result($user, 0, 2); ?>"/><br />
							<br />
							Contact #&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input name="contact" style="width: 200px" type="text" value="<?php echo mysql_result($user, 0, 3); ?>"/><br />
							<br />
							Date Active&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input name="date_active" style="width: 200px" type="text" value="<?php echo mysql_result($user, 0, 6); ?>"/><br />
							<br />
							Date Inactive&nbsp;&nbsp;&nbsp;&nbsp;
							<input name="date_inactive" style="width: 200px" type="text" value="<?php echo mysql_result($user, 0, 7); ?>"/><br />
							<br />
							User Group&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
							<select name="user_group" style="width: 200px">
							<option value ="<?php echo mysql_result($user, 0, 4); ?>" selected="selected"><?php echo mysql_result($user, 0, 4); ?></option>							<option>student</option>
							<option>faculty</option>
							<option>staff</option>
							<option>Labbie</option>
							<option>Floater</option>
							<option>ECS Computing Services</option>
							<option>Service Center</option>
							<option>admin</option>
							</select><br />
							<br />
							Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input name="username" style="width: 200px" type="text" readonly="readonly"
							value="<?php echo mysql_result($user, 0, 8); ?>"/>&nbsp;&nbsp;<span><font color="red"> <?php echo $_SESSION['usernameError']; ?></font><br />
							<br />
							Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input name="password" style="width: 200px" type="password" />&nbsp;&nbsp;<font color="red"> <?php echo $_SESSION['mismatchError']; ?></font><br />
							<br />
							Re-enter <br />
							Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input name="password1" style="width: 200px" type="password" /><br />
							<br />
							<br />
							</span><br />						
												
							<br />
							<br />
							<input name="Submit1" type="submit" value="Update" /> </div>
		</div>
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
</body>
</html>
