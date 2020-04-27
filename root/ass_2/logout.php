<?php
	session_start();
	echo "You have logged out </br>";
	echo "If you want to login again go <a href='login.php'>HERE</a>";
	session_destroy();//session is destroyed as soon as this page is accessed.
?>