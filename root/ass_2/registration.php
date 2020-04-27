<html>
	<body>
		<form action="registration.php" method="POST">
		Insert Firstname <input type="text" name="firstname"> <br />
		Insert Lastname <input type="text" name="lastname"> <br />		
		Insert Username <input type="text" name="user"> <br />
		Insert Password <input type="password" name="password"> <br/>
		Confirm Password <input type="password" name="confirm"> <br/>
		<input type="submit" value="submit">
		</form>		
	</body>
</html>
<?php
	include("db_selection.php"); //include script from external file
	include("errorlogs.php"); //Include script from external file
	include("stats.php");//Include stats calculator code
	$page_name = "Page: Registration";//Used to describe the page for the error log
	$stat_name = "Register";//Value for stats table in the database, allows to recognize what page is visited.
	countpage($stat_name, $sql_conn);//Calls function from stats, updates values on the database to generate stats
	
	if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['user']) && !empty($_POST['password']) && !empty($_POST['confirm'])){	
		
		$regex="/^[a-z\d\._-]+@([a-z\d-]+\.)+[a-z]{2,6}$/i";//Regular expression to check email formats 
		$p_len= strlen($_POST['password']);//strlen used to check the number of characters inputted in the password field 
		
		if($_POST['password'] != $_POST['confirm']){//Checking if password and the confirmation are same.
			$p_error = "Password confirmation and Password don't match.";	
			echo $p_error . " Make sure that the same password is used.";//if they don't match, error message is displayed. 
			errorLog($p_error, $page_name);//Logging the error in the text file
		}
				
		elseif($p_len <= 5){ //checking if the password is less than 5
			$l_error = "Password is too short.";
			echo $l_error . "Password must be more than 5 characters.";//message is displayed if the password is less than 5 characters 
			errorLog($l_error, $page_name);//Logging the error in the text file
		}
		
		elseif(preg_match($regex, $_POST['user'])) {//Matching the username from the form with the regular expression
			//Data from form saved in local variables
			$fname = $_POST['firstname'];
			$lname = $_POST['lastname'];
			$uname = $_POST['user'];
			$pword = $_POST['password'];
		
			//Encryption through salt and md5
			$len = rand(0, 20); 
			$salt = "";
			$range = "_!@#$^~abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
			$length = strlen($range);
			$randLen = rand(0, 50);
			for($i = 0; $i < $randLen; $i++){
				$indexChar = rand(0, $length - 1);
				$salt.=$range[$indexChar];
			}
			
			$encryption = md5($salt. md5($pword.$salt));
			
			//SQL syntax to query an insertion
			$sql = "insert into tbl_users(Firstname, Lastname, Username, Password, saltString) values ('$fname', '$lname', '$uname', '$encryption', '$salt')";
			
			//Execution of the sql query
			$insertion = mysqli_query($sql_conn, $sql);
			
			if(!$insertion){//checking if the query ran successfully
				if(mysqli_error($sql_conn) == "Duplicate entry '". $uname ."' for key 'Username'"){//This statements checks if the username already exists on the database
					$u_error = "Username already exists.";
					echo $u_error;//if unsername already exists, display this message.
					errorLog($u_error, $page_name);//Logging the error in the text file
				}
				else{
					errorLog(mysqli_error($sql_conn), $page_name);//Logging the error in the text file
					die("Error Occured: " . mysqli_error($sql_conn));//if error occured with the query, die function exits the code and sqli_error displays the exact error that happened while running the query.
				}
			}
			
			mysqli_close($sql_conn);//close the database connection
			
			if($insertion){
					echo "$uname Successfully added to the database </br>";//if query was succesfull, display confirmation message.
					echo "Please Log in  <a href='login.php'> Here </a>";
			}
		
		}
		
		else{//Matching the username from the form with the regular expression
			$e_error = "Invalid Email.";
			echo $e_error . " Please enter a valid Email.";//if the username is not entered, error message is displayed.
			errorLog($e_error, $page_name);//Logging the error in the text file
		}
			
		
	}
	
	else {
		echo "Insert values. Make sure all fields are filled";
	}








?>