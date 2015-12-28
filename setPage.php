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
</style>
<div>
<center><button class="tcf_header" type="submit" onclick="window.location.href='sportPage.php'" /></center>
</div>
<body>
<?php
$sport = $_SESSION['sport'];
$year = $_SESSION['year'];
$letter = $_SESSION['letter'];

//connect to the db
require ('mysqli_connect.php');
	
	//make the query:
	$q = "SELECT id, year, set_name, top_loader, nine_hundred, triple_shoe
		  FROM $sport
		  WHERE year = $year AND set_name LIKE $letter";
	//run the query
	$r = @mysqli_query ($dbc, $q);
	//if it runs ok, display the records
	if ($r)
	{
		//table header
		echo '<table class="tcf_table_header" align="center" cellspacing="3" cellpadding="3" width="75%">
		<tr class="tcf_table_header">
		<td class="tcf_table_header" align="left"><b>Year</b></td>
		<td class="tcf_table_header" align="left"><b>Set</b></td>
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
	  $resultsRow[0] = $row['id'];
	  $resultsRow[1] = $row['year'];
	  $resultsRow[2] = $row['set_name'];
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
	  <tr><td id="turnWhite" class="tcf_table" align="left">' . $resultsArray[$i][1] . '</td>
	  <td id="turnWhite" class="tcf_table" align="left">' . $resultsArray[$i][2] . '</td>
	  <td><input name="update" type="submit" value="' . $resultsArray[$i][1] . '_' . $resultsArray[$i][2] . '" /></td>
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