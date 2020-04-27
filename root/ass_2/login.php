<html>
	<body>
		<form action="login.php" method="POST">	
		Insert Username <input type="text" name="user"> <br />
		Insert Password <input type="password" name="password"> <br/>
		<input type="submit" value="submit">
		</form>		
	</body>
</html>

<?php
	session_start();
	include("db_selection.php");//Incldues the database connection file
	include("errorlogs.php");//Include error log script
	include("stats.php");//Include stats calculator code
	$regex="/^[a-z\d\._-]+@([a-z\d-]+\.)+[a-z]{2,6}$/i";//Regular expression to check email formats
	$page_name = "Page: Login";//Used to describe the page for the error log
	$stat_name = "Login";//Value for stats table in the database, allows to recognize what page is visited.
	countpage($stat_name, $sql_conn);//Calls function from stats, updates values on the database to generate stats
	
	if(!empty($_POST['user']) && !empty($_POST['password'])){//Checks if the form is empty
		if(preg_match($regex, $_POST['user'])){	
		
			$username = $_POST['user'];//Stores data from the form in local variables
			$password = $_POST['password'];
			$saltQry = mysqli_query($sql_conn, "SELECT saltString From tbl_users Where Username = '$username'");
			$salt = '';
			$result = mysqli_fetch_assoc($saltQry);
			$salt = $result['saltString'];
			$encryption = md5($salt. md5($password.$salt));
				
			$username = stripslashes($username);//Deletes Slashes from the variable
			$password = stripslashes($password);
			$username = mysql_real_escape_string($username);//Deletes special character 
			$password = mysql_real_escape_string($password);//Deletes special character
			
			$sql = "SELECT * FROM tbl_users WHERE Username = '$username' && Password = '$encryption'"; //Check if variables values exists 
					
			$query = mysqli_query($sql_conn, $sql); //Runs The query 
			
			if(!$query){
				errorLog(mysqli_error($sql_conn), $page_name);//Logging the error in the text file
				die("Error Occured: " . mysqli_error($sql_conn));//Displays error message if error occured while running the query 
			}
			else{
				$rows = mysqli_num_rows($query);//Counts the number of rows returned from the query
				
				if($rows == 1){//Checks if the number of rows returned is equal to 1, if true, session is created and user has logged in.
					$_SESSION['name'] = $username;//Creating the session
					echo "You have successfully Logged in. </br>";
					echo "Please go to our Members page: <a href='member.php'> Members </a>";//Link to members page, accessible only if user has logged in and if session was created
				}
				
				else{
					$u_error = "Username or Password are incorrect.";
					echo $u_error;//Display message if username and password is wrong.
					errorLog($u_error, $page_name);//Logging the error in the text file
				}
			}
			mysqli_close($sql_conn);//Closes the connection
		}
		else {
			$e_error = "Please Enter a valid Email Address.";
			echo $e_error;
			errorLog($e_error, $page_name);//Logging the error in the text file
		}
	}
	
	else {
		echo "To login, Please enter username and password. Make sure all fields are filled or register <a href='registration.php'>HERE</a>.";//Message displayed if user has not entered anything on the form. 
	}
	











?>