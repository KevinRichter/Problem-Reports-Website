<?php

		$dbhost = "athena.ecs.csus.edu";
		$dbuser = "recursion";
		$dbpass = "recursion_db";
		$dbname = "recursion";
		$con = mysql_connect("$dbhost","$dbuser","$dbpass") or die(mysql_error());	
		mysql_select_db("$dbname") or die("no database by that name");
				
?>
