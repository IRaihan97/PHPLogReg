<?php
	session_start();
	include("errorlogs.php");//Include error log external file
	include("db_selection.php");//Include database connection
	include("stats.php");//Included stats calculator file
	$page_name = "Page: Members";//This is made to write the page name in the error log
	$stat_name = "Member";//Value for stats table in the database, allows to recognize what page is visited.
	countpage($stat_name, $sql_conn);
	
	if($_SESSION['name'] == ""){//Checking if session exists
		$error = "User attempted to enter while session did not exist";
		errorLog($error, $page_name);//Logging the error in the text file
		header("Location: login.php");//Redirect to login page if session does not exist
	}
	
	else{
		echo "Hello " . $_SESSION['name'] . " Welcome To the Members Page<br>";//Welcome message to members page
		echo "<a href='logout.php'> LOGOUT </a> </br>";//Logout link to destroy the session
		
	}






?>