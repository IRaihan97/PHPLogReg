<?php
	function errorLog($get_error, $page){//This function is created to be used in other files.
		date_default_timezone_set('Europe/London');//Sets the right timezone for the date function.
		$ip = $_SERVER['REMOTE_ADDR'];//Gets Ip address
		$date = date("d/m/y");//Gets the date
		$time = date("h:i:sa");//Gets the time
		$error = $get_error;//Assigns value of $getError to a local variable
		$log = "$page, $date, $time, $ip, $error \n";//Singular string including all the data for the error log
		$f_location = "logs/error.txt";//Location of the text file
		$file = fopen($f_location, 'a+');//Opens up the text file as append mode
		fwrite($file, "$log");//Writes the string to the text file
		fclose($file);//Closes the text file.
	}

?>