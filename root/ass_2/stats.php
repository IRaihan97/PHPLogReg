<?php	
	function countpage($page, $connection){//Function is created in a separate file for better modularity, values are passed through parametres 
		$sql = "UPDATE stats SET Visits=Visits+1 WHERE Page='$page'";//Sql code do update stats table in the database, increments by one the value in VISITS Whenever the quert is executed. 
		mysqli_query($connection, $sql);

	}
?>