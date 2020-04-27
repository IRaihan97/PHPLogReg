<?php
	include("db_selection.php");//Include database connection
	$sql_result = "SELECT * FROM stats";//Sql to select all data from stats table in the database
	$result = mysqli_query($sql_conn, $sql_result);//Runs the query 
	
	//Generate table to display stats
	echo "<table border= '1' cellpadding = '2'>";
	echo "<tr> <th> Pagename </th>";
	echo "<th> Visits </th> </tr>";

	
	while($row = mysqli_fetch_array($result)){//data return by the query is saved on an array and displayed in the table	
		echo "<tr> <td>".$row["Page"]."</td>";
		echo "<td>".$row["Visits"]."</td> </tr>";
		$data = "Page: " . $row['Page'] . " has been visited " . $row['Visits'] . " times\n";
		$path = "logs\stats.txt";//Path of the txt file
		$file = fopen($path, 'a+');//Opens text file
		fwrite($file, $data);//Writes the data on the file 
		fclose($file);//Closes the text file 
		
	}
	
	
	echo "</table>";
	

?>