<?php
	//Connect to MySQL
	
	$host = "localhost";//Database host name
	$user = "root";//db username for USBWebServer
	$password = "usbw";//password for USBWebServer
	$db_name = "assignment2";//name of the database
	
	//Create a database connection
	$sql_conn = mysqli_connect($host, $user, $password);
	
	//If statement with error function
	if(!$sql_conn){
		die("Database Connection Falied:" . mysqli_error($sql_conn));//displays error message
	}
	
	//Select the database to be used
	$db_select = mysqli_select_db($sql_conn, $db_name);
	//if statement for error message
	if(!$db_select){
		die("Database connection Failed:" . mysqli_error($sql_conn));
	}





?>