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
<div class="freeze">
<button class="tcf_header" type="submit" onclick="window.location.href='sportPageV2.php'" />
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
		for($j = 0; $j < count($_SESSION['details']); $j++)
		{
			$num = $_SESSION['details'][$j][0];
			$qty_update = htmlspecialchars($_POST['data2'][$_SESSION['details'][$j][0]]['qty']);
			$p1_update = htmlspecialchars($_POST['data2'][$_SESSION['details'][$j][0]]['p1']);
			$p2_update = htmlspecialchars($_POST['data2'][$_SESSION['details'][$j][0]]['p2']);
		
		
			//validate the form input
			if(is_numeric($qty_update) &&
				is_numeric($p1_update) &&
				is_numeric($p2_update))
			{
				if($qty_update != $_SESSION['details'][$j][1] || $p1_update != $_SESSION['details'][$j][6] || 
					$p2_update != $_SESSION['details'][$j][7])//make the query:
				{
					$q = "UPDATE $table SET quantity=$qty_update, price_1=$p1_update, price_2=$p2_update WHERE card_id=$num";
					//run the query
					$r = @mysqli_query ($dbc, $q);
					if($r)
					{echo '<center>' . $_SESSION['details'][$j][4] . ' ' . $_SESSION['details'][$j][5] . ' has been updated.</center>';}
				}//end of if statement that checks to see if the data has been changed
			}//end of if statement that checks if the form data is a number
			else
				{echo '<center>Error: non-numeric value entered.</center>';}
		}//end of for statement that cycles through the form data		
	}//end if statement that checks to see if the form was submitted
	
	//make the query:
	$q = "SELECT *  FROM $table";
	//run the query
	$r = @mysqli_query ($dbc, $q);
	//if it runs ok, display the records
	if ($r)
	{
		//table header
		echo '<table>
		<tr class="header">
		<td class="setCol_qty"><b>Qty</b></td>
		<td class="setCol_year"><b>Year</b></td>
		<td class="setCol_detailsPage"><b>Set</b></td>
		<td class="setCol_cardNum"><b>#</b></td>
		<td class="setCol_detailsPage"><b>Name</b></td>
		<td class="setCol_price"><b>High</b></td>
		<td class="setCol_price"><b>Low</b></td>
		<td class="setCol_submitHeading"><b>Submit</b></td>
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
	  $resultsRow[0] = $row['card_id'];
	  $resultsRow[1] = $row['quantity'];
	  $resultsRow[2] = $row['year'];
	  $resultsRow[3] = $row['set_name'];
	  $resultsRow[4] = $row['card_number'];
	  $resultsRow[5] = $row['name'];
	  $resultsRow[6] = $row['price_1'];
	  $resultsRow[7] = $row['price_2'];
	  //add the resultsRow array to the resultsArray
	  $resultsArray[$counter] = $resultsRow;	  
	  //update the counter
	  $counter++;
	}//end while statement
	
	//add the results array to the session array
	$_SESSION['details']=$resultsArray;
	//display the results
	for($i=0; $i < count($resultsArray); $i++)
	{
	  echo '<form method="post" action="detailsPageV2.php">
	  <tr class="table">
	  <td id="matchBackground"><input class="setInputWidth_80" name="data2[' . $resultsArray[$i][0] . '][qty]" type="text"
	  value="' . $resultsArray[$i][1] . '"</td>
	  <td class="setCol_year">' . $resultsArray[$i][2] . '</td>
	  <td class="setCol_detailsPage">' . $resultsArray[$i][3] . '</td>
	  <td class="setCol_cardNum">' . $resultsArray[$i][4] . '</td>
	  <td class="setCol_detailsPage">' . $resultsArray[$i][5] . '</td>
	  <td id="matchBackground"><input class="setInputWidth_90" name="data2[' . $resultsArray[$i][0] . '][p1]" type="text"
	  value="' . $resultsArray[$i][6] . '"</td>
	  <td id="matchBackground"><input class="setInputWidth_90" name="data2[' . $resultsArray[$i][0] . '][p2]" type="text"
	  value="' . $resultsArray[$i][7] . '"</td>
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
		echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
	}//end of else where query did not run
?>
</body>
</html>