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
	<link href="css/tcf_table.css" rel="stylesheet">
	<title>TCF Overflow Inventory</title>
</head>
<?php
session_start();
?>
<div>
<center><button class="tcf_header" type="submit" onclick="window.location.href='sportPageV2.php'" /></center>
</div>
<body>
<?php
$sport = $_SESSION['sport'];
$year = $_SESSION['year'];
$letter = $_SESSION['letter'];

//connect to the db
require ('mysqli_connect.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	for($j = 0; $j < count($_SESSION['array']); $j++)
	{
		$id = $_SESSION['array'][$j][0];
		$tl_update = htmlspecialchars($_POST['data'][$_SESSION['array'][$j][0]]['tl']);
		$nh_update = htmlspecialchars($_POST['data'][$_SESSION['array'][$j][0]]['nh']);
		$ts_update = htmlspecialchars($_POST['data'][$_SESSION['array'][$j][0]]['ts']);

		//validate the form input
		if(is_numeric($tl_update) &&
			is_numeric($nh_update) && 
			is_numeric($ts_update))
			{
				if($tl_update != $_SESSION['array'][$j][3] || $nh_update != $_SESSION['array'][$j][4] || 
				$ts_update != $_SESSION['array'][$j][5])//make the query:
				{
					$q = "UPDATE $sport SET top_loader=$tl_update, nine_hundred=$nh_update, triple_shoe=$ts_update WHERE id=$id ";
					//run the query
					$r = @mysqli_query ($dbc, $q);
					if($r)
					{echo '<center>' . $_SESSION['array'][$j][1] . ' ' . $_SESSION['array'][$j][2] . ' has been updated.</center>';}
				}//end of if statement that checks to see if the data has been changed
			}//end of if statement that checks if the form data is a number
		else
			{echo '<center>Error: non-numeric value entered.</center>';}
	}//end of for statement that cycles through the form data
}//end if statement that checks to see if the form was submitted
	
	/*$numRecords = 100;//set the max number of records to display
	$page = 1;//set the current page number to 1
	$numPages = 1;//initialize the number of pages
	$startRec = 1;//intialize the starting record
	$endRec = 100;//initialize the end record
	//if(isset($_GET['numRecords'])*/
	//make the query:
	$q = "SELECT id, year, set_name, top_loader, nine_hundred, triple_shoe
		  FROM $sport
		  WHERE year LIKE $year AND set_name LIKE $letter ORDER BY year ASC, set_name ASC";
	//run the query
	$r = @mysqli_query ($dbc, $q);
	//if it runs ok, display the records
	if ($r)
	{
		/*echo '<form method="post" action="updatePageV2.php">
		<center>Page <input size="1" name="page" type="text" align="left" value="' . $page . '"> of ' . $numPages . '
		<select>
			<option value="100">100</option>
			<option value="250">250</option>
			<option value="500">500</option>
			<option value="1000">1000</option>
			<option value="all">all</option>
		</select></center>';*/
		//table header
		echo '<table>
		<tr class="header">
		<td class="setCol_year"><b>Year</b></td>
		<td class="setCol_setUpdate"><b>Set</b></td>
		<td class="setCol_top_loader"><b>Top Loader</b></td>
		<td class="setCol_900"><b>900 Box</b></td>
		<td class="setCol_triple"><b>Triple Shoe</b></td>
		<td id="matchBackground"><form method="post" action="setPageV2.php">
		<input class="input.setButton_Display" name="submit" type="submit" value="Details"></td></form>
		</tr>';
		//create a 2 dimmensional array to store the results of the query
		$resultsArray = array();
		$resultsRow = array();
		//initailize the counter
		$counter = 0;
		//create a variable to tell if this is the first row
		$isFirstRow = true;
		//fetch and process the query results
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
	{	
	  //store the query results in the resultsRow array
	  $resultsRow[0] = $row['id'];
	  $resultsRow[1] = $row['year'];
	  $resultsRow[2] = $row['set_name'];
	  $resultsRow[3] = $row['top_loader'];
	  $resultsRow[4] = $row['nine_hundred'];
	  $resultsRow[5] = $row['triple_shoe'];
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
	  echo '<form method="post" action="updatePageV2.php">
	  <tr class="table">
	  <td class="setCol_year">' . $resultsArray[$i][1] . '</td>
	  <td class="setCol_setUpdate">' . $resultsArray[$i][2] . '</td>
	  <td id="matchBackground"><input class="setInputWidth_90" name="data[' . $resultsArray[$i][0] . '][tl]" type="text" value="' . $resultsArray[$i][3] . '"</td>
	  <td id="matchBackground"><input class="setInputWidth_90" name="data[' . $resultsArray[$i][0] . '][nh]" type="text" value="' . $resultsArray[$i][4] . '"</td>
	  <td id="matchBackground"><input class="setInputWidth_90" name="data[' . $resultsArray[$i][0] . '][ts]" type="text" value="' . $resultsArray[$i][5] . '"</td>
	  <td id="matchBackground"><input class="input.setButton_Submit" name="submit" type="submit" value="Submit" /></td>
	  </tr>';
	}//end of for loop

	echo '</table></form>'; // Close the table and form
	mysqli_free_result ($r); // Free up the resources.	
	}//end of if statement that checks to see if the query ran ok																				
 else 
	{
		// If it did not run OK.
		// Public message:
		echo '<p class="error">Error: The data you requested is unavailable. We apologize for any inconvenience.</p>';
		// Debugging message:
		echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
	}//end of else where query did not run
?>
</body>
</html>