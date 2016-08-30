
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
	include_once('library.php');
	session_start();
	$example = new Library();
 ?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
			<?php
			echo $_SESSION[YOUR_ESCALATION]
			
			?>	
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>ECS Problem Reports</title>
<link rel="stylesheet" type="text/css" href="main.css" />
</head>

<body background="img/bg.png" alt = "bg">

   <!-- Begin Wrapper -->
   <div id="wrapper">
   
         <!-- Begin Header -->
         <div id="header" style="width=100%;">
		 
		       <img src = "img/header.png" alt = "header-bg">	 
			   
		 </div>
		 <!-- End Header -->
		 
		 <!-- Begin Left Column -->
		 <div id="leftcolumn" style="height=100%;">
		 
		   	   
		 
		 </div>
		 <!-- End Left Column -->
		 
		 <!-- Begin Right Column -->
		 <div id="rightcolumn">
<span style="cursor:default"></span><br>

<FORM NAME ="form" METHOD ="POST" ACTION = "problem_report.php">
<h4>First Name:
<INPUT NAME = "firstName" TYPE = "TEXT" VALUE = "First Name" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;"/></h4>
<br>
<h4>Last Name:
<INPUT NAME = "lastName" TYPE = "TEXT" VALUE = "Last Name" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;"/></h4>
<br>


<h4>Email: 
<INPUT NAME = "email" TYPE = "TEXT" VALUE = "email@domain.com" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;"/></h4>
<br>
<hr>
<br>
<h4> Category:
<select name = "category">
	<option value = "mouse">Mouse</option>
	<option value = "keyboard">Keyboard</option>
	<option value = "printer">Printer</option>
	<option value = "hardware">Hardware</option>
	<option value = "software">Software</option>
	<option value = "lockedSystem">Locked System</option>
	<option value = "other">Other</option>
</select></h4>
<br>
<h4>Priority
<select name = "priority">
	<option value = "low">Low</option>
	<option value = "medium">Medium</option>
	<option value = "high">High</option>
</select></h4>
<br>
<hr>
<br>
<h4>Subject
<INPUT NAME = "subject" TYPE = "TEXT"></h4>
<br>
<h4>Problem Description<br><textarea rows="5" cols="20" name="problemDescription" wrap="physical" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;"/>Please describe the problem</textarea></h4><br />

<hr>
<br>
<h4>System Type
<select name = "system">
	<option value = "workstation">Workstation</option>
	<option value = "pc">PC</option>
	<option value = "mac">MAC</option>
	<option value = "laptop">Laptop</option>
</select></h4>
<br>
<h4>Room and number
<select name = "room">
	<option value = "RVR">RVR</option>
	<option value = "SCL">SCL</option>
	<option value = "AIRC">AIRC</option>
</select>
<INPUT NAME = "roomNumber" TYPE = "TEXT" value = "Room #" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;"/></h4>

<br>
<h4>Position Room
<INPUT NAME = "positionRoom" TYPE = "TEXT" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;"/></h4>
<br>
<h4>Problem Type:
Personal:<input TYPE = "radio" value = "personal" name = "problemType">
CPE/EEE:<input TYPE = "radio" value = "CPE/EEE" name = "problemType">
Other Labs:<input TYPE = "radio" value = "otherLabs" name = "problemType">
<br></h4>
<br>
<h4>Computer Name
<INPUT NAME = "computerName" TYPE = "TEXT" ></h4>
<br>


<INPUT TYPE = "Submit" NAME = "submit" VALUE = "Submit" />


</FORM>		 
			  
		 </div>
		 <!-- End Right Column -->
		 
   </div>
   <!-- End Wrapper -->
   
</body>
</html>