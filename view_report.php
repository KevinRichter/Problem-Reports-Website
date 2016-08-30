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
	$report_id = $_GET['ID'];
	if ($_SESSION['user_group'] != 'student' && $_SESSION['user_group'] != "faculty") header("Location:internal_view.php?ID=$report_id");
	$result = mysql_query("SELECT * FROM p_report WHERE ID='".$report_id."'");

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
<title>Report a Problem</title>
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
	color: #0000FF;
}
.auto-style5 {
	text-decoration: underline;
}
.auto-style6 {
	color: #0000FF;
}
.auto-style7 {
	color: #0000FF;
	text-decoration: underline;
}
.auto-style8 {
	text-decoration: none;
}
</style>
 
<script type="text/javascript">
function CheckCat(val){
 var element=document.getElementById('Category');
 if(val=='Other') {
   element.style.marginLeft = "125px"; 	
   element.style.display='block';   
 } else  
   element.style.display='none';
}
function CheckSys(val){
 var element=document.getElementById('System_type');
 if(val=='Other') {
   element.style.marginLeft = "125px"; 	
   element.style.display='block';   
 } else  
   element.style.display='none';
}
function resetForm($form) {
    $form.find('input:text, input:password, input:file, select, textarea').value('');
    $form.find('input:radio, input:checkbox')
         .removeAttr('checked').removeAttr('selected');
    
    <?php $category = 'Select a Category'; ?>
}
</script> 

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
						<span class="auto-style2">Report View<br />
						</span><br />
						<br />
						<form action="search.php" method="post" name="problemReportForm">
							<span class="auto-style3">
							<font color="red"><?php echo $_SERVER['idError']; echo "\n";?></font>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red"><?php echo $_SESSION['missingInfo1']; ?></font>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<span class="auto-style5"><strong>
							</strong></span><br />
							Subject:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="Subject" type="text" readonly="readonly" value ="<?php echo mysql_result($result, 0, 1); ?>" style="width: 200px" /> (Briefly 
							identify problem)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<span class="auto-style4"></span><br />
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<font color="red"><?php echo $_SESSION['missingInfo2']; ?></font><br />
							Description:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 							
							<textarea name="Description" readonly="readonly" style="width: 400px; height: 81px;"><?php echo mysql_result($result, 0, 2); ?></textarea> 
							<br />
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<font color="red"><?php echo $_SESSION['missingInfo3']; ?></font><br />
							Category:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--<select name='Category2' id='Category2' 
							onchange ='CheckCat(this.value);' style="width: 200px">
							<option value ="<?php if($_SESSION['category'] != NULL) $category = $_SESSION['category']; else $category = 'Select a Category'; ?><?php echo $category; ?>" selected="selected"><?php echo $category; ?></option>							
							<option value="Update Software">Update Software</option>
							<option value="Broken Hardware">Broken Hardware</option>
							<option value="Software Missing">Software Missing</option>
							<option value="Missing Hardware">Missing Hardware</option>
							<option value="Other">Other</option>
							</select>-->&nbsp;&nbsp;&nbsp; <input type='text' name='Category'	style="width: 200px" readonly="readonly" id='Category' value ="<?php echo mysql_result($result, 0, 3); ?>"/>
							</span>
							<br />
							<br />
							<?php 
								// Sets default due date for use in drop downs
								$due_date = strtotime("+ 1 week 3 days");
								$month = date('M', $due_date);
								$day = date('d', $due_date);
								$year = date('Y', $due_date);
							?>
							<span class="auto-style3">Due Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Month 
							<input type='text' name='Month'	style="width: 60px" readonly="readonly" id='Month' value ="<?php echo mysql_result($result, 0, 24); ?>"/>
							<!--<select name="Month" style="width: 60px">
							<option value ="<?php if($_SESSION['month_due'] != NULL) $month = $_SESSION['month_due']; else $month = date('M', $due_date); ?><?php echo $month; ?>" selected="selected"><?php echo $month; ?></option>
							<option>Jan</option>
							<option>Feb</option>
							<option>Mar</option>
							<option>Apr</option>
							<option>May</option>
							<option>Jun</option>
							<option>Jul</option>
							<option>Aug</option>
							<option>Sep</option>
							<option>Oct</option>
							<option>Nov</option>
							<option>Dec</option>
							</select> -->
							Day 
							<input type='text' name='Day'	style="width: 45px" readonly="readonly" id='Day' value ="<?php echo mysql_result($result, 0, 25); ?>"/>
							<!--<select name="Day" style="width: 45px">
							<option value ="<?php if($_SESSION['day_due'] != NULL) $day = $_SESSION['day_due']; else $day = date ('d', $due_date); ?><?php echo $day; ?>" selected="selected"><?php echo $day; ?></option>
							<option>01</option>
							<option>02</option>
							<option>03</option>
							<option>04</option>
							<option>05</option>
							<option>06</option>
							<option>07</option>
							<option>08</option>
							<option>09</option>
							<option>10</option>
							<option>11</option>
							<option>12</option>
							<option>13</option>
							<option>14</option>
							<option>15</option>
							<option>16</option>
							<option>17</option>
							<option>18</option>
							<option>19</option>
							<option>20</option>
							<option>21</option>
							<option>22</option>
							<option>23</option>
							<option>24</option>
							<option>25</option>
							<option>26</option>
							<option>27</option>
							<option>28</option>
							<option>29</option>
							<option>30</option>
							<option>31</option>
							</select> -->
							Year
							<input type='text' name='Year'	style="width: 70px" readonly="readonly" id='Year' value ="<?php echo mysql_result($result, 0, 26); ?>"/>
							<!--<select name="Year" style="width: 70px">
							<option value ="<?php if($_SESSION['year_due'] != NULL) $year = $_SESSION['year_due']; else $year = date ('Y', $due_date); ?><?php echo $year; ?>" selected="selected"><?php echo $year; ?></option>
							<option>2012</option>
							<option>2013</option>
							<option>2014</option>
							<option>2015</option>
							<option>2016</option>
							<option>2017</option>
							<option>2018</option>
							<option>2019</option>
							<option>2020</option>
							</select> -->
							&nbsp;<br />
							<br />
							System Type:&nbsp;&nbsp;&nbsp;&nbsp;							
							<!--<select name="System_type2" onchange ='CheckSys(this.value);' style="width: 200px">
							<option value ="<?php if($_SESSION['system_type'] != NULL) $sys_type = $_SESSION['system_type']; else $sys_type = 'Select a System Type'; ?><?php echo $sys_type; ?>" selected="selected"><?php echo $sys_type; ?></option>
							<option>Workstation</option>
							<option>PC</option>
							<option>Mac</option>
							<option>Laptop</option>
							<option>Tablet/Phone</option>
							<option>Other</option>
							</select>-->
							&nbsp;&nbsp;
							<input type='text' name='System_type' readonly="readonly" id='System_type' value ="<?php echo mysql_result($result, 0, 9); ?>"/>
							<br />
							<br />
							Problem Type:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 							<input type='text' name='Problem_type' readonly="readonly" id='Problem_type' value ="<?php echo mysql_result($result, 0, 13); ?>"/>
							<!--<select name="Problem_type" style="width: 200px">
							<option value ="<?php if($_SESSION['prob_type'] != NULL) $prob_type = $_SESSION['prob_type']; else $prob_type = 'Lab'; ?><?php echo $prob_type; ?>" selected="selected"><?php echo $prob_type; ?></option>
							<option>lab</option>
							<option>faculty</option>
							<option>staff</option>
							<option>student</option>
							<option>cpe-eee_labs</option>
							</select>-->
							<br />
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<font color="red"><?php echo $_SESSION['missingInfo4']; echo $_SESSION['missingInfo5']; ?></font><br />
							Location:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							Room:&nbsp;&nbsp;<input type='text' name='Building' readonly="readonly" id='Building' value ="<?php echo mysql_result($result, 0, 10); ?>" style="width: 80px"/>
							<!--<select name="Building" style="width: 50px">
							<option value ="<?php echo $_SESSION['room_building']; ?>" selected="selected"><?php echo $_SESSION['room_building']; ?></option>
							<option>RVR</option>
							<option>SCL</option>
							<option>ARC</option>
							</select>-->
							&nbsp; Number:
							<input type='text' name='Room_number' id='Room_number' readonly="readonly" value ="<?php echo mysql_result($result, 0, 11); ?>" style="width: 100px"/>
							<!--<input name="Room_number" style="width: 57px" type="text" 
							value ="<?php echo $_SESSION['room_number']; ?>" /> -->
							&nbsp;
							<br />
							<br />
							Computer Name:&nbsp;&nbsp;&nbsp;&nbsp;
							<input name="Computer_name" style="width: 200px" type="text"
							readonly="readonly" value ="<?php echo mysql_result($result, 0, 14); ?>" />&nbsp;
							<br />
							<br />
							Where in Room:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 					<input name="Position_room" style="width: 200px" type="text" 
							readonly="readonly" value ="<?php echo mysql_result($result, 0, 12); ?>" /><br />
							<br />
							<br />							 
							Reporter Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="Fullname" style="width: 200px" type="text" 
							readonly="readonly" value ="<?php echo mysql_result($result, 0, 15); ?>" /><br />
							<br />
							Reporter Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="Email_adr" style="width: 200px" type="text"
							readonly="readonly" value ="<?php echo mysql_result($result, 0, 16); ?>" /><br />
							</span>
							<br />
							<span class="auto-style3">
							Status:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input name="Status" style="width: 200px" type="text"
							readonly="readonly" value ="<?php echo mysql_result($result, 0, 19); ?>" />
							<!--put name="Email" style="width: 200px" type="text"
							value ="<?php echo $_SESSION['email_adr']; ?>" />-->
							<br />
							<br />
							Resolution:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 							
							<textarea name="Resolution" readonly="readonly" style="width: 400px; height: 81px;"><?php echo mysql_result($result, 0, 18); ?></textarea> 							
							<!--<input name="Contact" style="width: 200px" type="text"
							value ="<?php echo $_SESSION['contact']; ?>" /> -->
							<br />
							<br />
							Date Completed:&nbsp;&nbsp;&nbsp;&nbsp;
							<input name="Completed" style="width: 200px" type="text"
							readonly="readonly" value ="<?php echo mysql_result($result, 0, 7); ?>" />
							<br />
							</span><br />		
							<br />
							<br />
							<input name="Submit1" type="submit" value="Back to results" />
							<br />
						</form>
					</div>
				</div>
			</div>
			<div style="clear:both;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<strong><span class="auto-style6">&nbsp;&nbsp;&nbsp;
							</span><span class="auto-style7">
							<span class="auto-style6">
							<a class="auto-style8" href="logout.php">&nbsp;</a><a href="logout.php">Logout</a></span></span></strong></div>
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
