<!DOCTYPE html PUBLIC "-//W3C//
DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/
xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/
1999/xhtml" xml:lang="en"
lang="en">
<head>
	<meta http-equiv="Content-Type"
	content="text/html;
	charset=utf-8"  />
	<link href="css/tcf_header.css" rel="stylesheet">
	<link href="css/tcf_background.css" rel="stylesheet">
	<link href="css/tcf_table_header.css" rel="stylesheet">
	<link href="css/tcf_table.css" rel="stylesheet">
	<link href="css/tcf_buttons.css" rel="stylesheet">
	<link href="css/tableText.css" rel="stylesheet">
	<title>TCF Overflow Inventory</title>
</head>
<?php
session_start();
?>
<style>
#turnWhite{background-color:white;}
#spWidth{width: 5em}
</style>
<div>
<center><button class="tcf_header" type="submit" onclick="window.location.href='sportPage.php'" /></center>
</div>
<body>
<?php
if(isset($_POST['update']))
{
	$table = $_POST['update'];
	$_SESSION['table'] = $table;
}
//connect to the db
require ('mysqli_connect_tcf_inventory.php');
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
	{
		$table = $_SESSION['table'];
		$num = $_POST['submit'];
		//validate the form input
		if(is_numeric($_POST['qty_update' . $num]) &&
			is_numeric($_POST['p1_update' . $num]) &&
			is_numeric($_POST['p2_update' . $num]))
		{
			$qty_update = $_POST['qty_update' . $num];
			$p1_update = $_POST['p1_update' . $num];
			$p2_update = $_POST['p2_update' . $num];

			//make the query:
			$q = "UPDATE $table SET quantity=$qty_update, price_1=$p1_update, price_2=$p2_update WHERE card_number='$num' ";
			//run the query
			$r = @mysqli_query ($dbc, $q);
			//if it runs ok print the set updated under the logo
			if($r)
			{
				//store the $_SESSION['array'] in a temp array
				$tempArray = array();
				$tempArray = $_SESSION['array'];
				//find the year and set name from the array
				for($j=0; $j < count($tempArray); $j++)
				{
					if($tempArray[$j][3] == $num)
					{echo '<center>' . $tempArray[$j][3] . ' ' . $tempArray[$j][4] . ' has been updated.</center>';}
				}//end of for statement that finds the year and set name
			}//end of if statement that checks to see if the update query ran
			else 
			{
				// If it did not run OK.
				// Public message:
				echo '<p class="error">The current users could not be retrieved. We apologize for any inconvenience.</p>';
				// Debugging message:
				echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
			}//end of else where query did not run
		}//end of if statement that validates the form data
	}//end if statement that checks to see if the form was submitted
	
	//make the query:
	$q = "SELECT *  FROM $table";
	//run the query
	$r = @mysqli_query ($dbc, $q);
	//if it runs ok, display the records
	if ($r)
	{
		//table header
		echo '<table class="tcf_table_header" align="center" cellspacing="3" cellpadding="3" width="75%">
		<tr class="tcf_table_header">
		<td class="tcf_table_header" align="left"><b>Qty</b></td>
		<td class="tcf_table_header" align="left"><b>Year</b></td>
		<td class="tcf_table_header" align="left"><b>Set</b></td>
		<td class="tcf_table_header" align="left"><b>#</b></td>
		<td class="tcf_table_header" align="left"><b>Name</b></td>
		<td class="tcf_table_header" align="left"><b>Price_1</b></td>
		<td class="tcf_table_header" align="left"><b>Price_2</b></td>
		<td class="tcf_table_header" align="left"><b>Submit</b></td>
		</tr>';
		//create a 2 dimmensional array to store the results of the query
		$resultsArray = array();
		$resultsRow = array();
		//initailize the counter
		$counter = 0;
		//fetch and process the query results
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
	{	
	  //store the query results in the resultsRow array
	  $resultsRow[0] = $row['quantity'];
	  $resultsRow[1] = $row['year'];
	  $resultsRow[2] = $row['set_name'];
	  $resultsRow[3] = $row['card_number'];
	  $resultsRow[4] = $row['name'];
	  $resultsRow[5] = $row['price_1'];
	  $resultsRow[6] = $row['price_2'];
	  //add the resultsRow array to the resultsArray
	  $resultsArray[$counter] = $resultsRow;	  
	  //update the counter
	  $counter++;
	}//end while statement
	//add the results array to the session array
	$_SESSION['array']=$resultsArray;
	//display the results
	for($i=0; $i < count($resultsArray); $i++)
	{
	  echo '<form method="post" action="detailsPage.php">
	  <tr><td><input id="spWidth" name="qty_update' . $resultsArray[$i][3] . '" type="text"
	  class="tcf_table" align="left" value="' . $resultsArray[$i][0] . '"</td>
	  <td id="turnWhite" class="tcf_table" align="left">' . $resultsArray[$i][1] . '</td>
	  <td id="turnWhite" class="tcf_table" align="left">' . $resultsArray[$i][2] . '</td>
	  <td id="turnWhite" class="tcf_table" align="left">' . $resultsArray[$i][3] . '</td>
	  <td id="turnWhite" class="tcf_table" align="left">' . $resultsArray[$i][4] . '</td>
	  <td><input id="spWidth"name=" p1_update' . $resultsArray[$i][3] . '" type="text"
	  class="tcf_table" align="left" value="' . $resultsArray[$i][5] . '"</td>
	  <td><input id="spWidth"name=" p2_update' . $resultsArray[$i][3] . '" type="text"
	  class="tcf_table" align="left" value="' . $resultsArray[$i][6] . '"</td>
	  <td><input id="spWidth" name="submit" type="submit" value="' . $resultsArray[$i][3] . '" /></td>
	  </tr>';
	}//end of for loop

	echo '</table></form>'; // Close the table and form
	mysqli_free_result ($r); // Free up the resources.	
	}//end of if statement that checks to see if the query ran ok																				


 else 
	{
		// If it did not run OK.
		// Public message:
		echo '<p class="error">The current users could not be retrieved. We apologize for any inconvenience.</p>';
		// Debugging message:
		echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
	}//end of else where query did not run
?>
</body>
</html>