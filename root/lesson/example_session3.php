<?php
//If form not submitted, display form
if (!isset($_POST['submit'])){
?>
<form method="post" action="example_session3.php">
<p>Please enter your information:</p>
City: <input type="text" name="city" />
Month: <input type="text" name="month" />

<p>Please choose the kinds of weather you experienced from the list below. Choose all that apply. </p>

<!--checkbox options-->
<input type="checkbox" name="weather[]" value="sunshine" />Sunshine<br />
<input type="checkbox" name="weather[]" value="clouds" />Clouds<br />
<input type="checkbox" name="weather[]" value="rain" />Rain<br />
<input type="checkbox" name="weather[]" value="hail" />Hail<br />

<p /> 
<input type="submit" name="submit" value="Go" />
</form>
 
<?php
//If form submitted, process input
} else {
//Retrieve the date and location information
$inputLocal = array(  $_POST['city'],  $_POST['month'],);

echo "In $inputLocal[0] in the month of $inputLocal[1], you observed the following weather:<br/><br/>";

//start of table
echo "<table border='1'>";
//Save weather array into a variable
$we=$_POST['weather'];
//Iterate through the array to show what the user chose. Creates a table row for each item in the array

$x=0;
foreach($we as $w)
	{
		
	$x++; //increment by 1 on each loop

	$class = ($x%2 == 0)? 'background-color:gray': 'background-color:white';
	//Using modulus - checks to see if $x is divisible evenly by 2. If it is, it is even
	//if you haven't seen that style of if else query, it is called a ternary operator
  	echo "<tr style='$class'><td> " .$w. "</td></tr>";  
	}
echo "</table>";
 }
?>