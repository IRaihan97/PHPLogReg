<?php
	$name = "Raihan"; //string to be inserted in the line
	$flocation = "text/name.txt"; //location of the file
	$fileopen = fopen($flocation, 'w'); //opens the file in the write mode
	fwrite($fileopen, $name);//writes $name on the file
	fclose($fileopen); //closes the file
	echo "Name $name inserted in the name text file\n";
	echo "Filesize $info\n";
	
?>