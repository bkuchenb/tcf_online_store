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
//check to see what letter was choosen on the previous page
//and format the $letter variable accordingly
if($_GET['letter'] == '%')
//if % was selected return all sets in inventory for the given year
{$letter = '\''. $_GET['letter']. '\'';}
//if any other letter was selected, return all sets that begin with that letter
else{$letter = '\''. $_GET['letter']. '%\'';} 
$_SESSION['letter'] = $letter;
//add the set and year choosen to local variables
$sport = $_SESSION['sport'];
if($_SESSION['year'] == '%')
{$year = '\'' . $_SESSION['year'] . '\'';}
else {$year = $_SESSION['year'];}
//$_SESSION['year'] = $year;//update the session variable for the updatePage

//connect to the tcf_overflow database
require ('mysqli_connect.php');
		
//make the query:
$q = "SELECT year, set_name, top_loader, nine_hundred, triple_shoe
      FROM $sport
	  WHERE year=$year AND top_loader > 0 AND set_name LIKE $letter ORDER BY year ASC, set_name ASC";
//run the query
$r = @mysqli_query ($dbc, $q);
//if it runs ok, display the records
if ($r)
{
	//table header
	echo '<table>
	<tr class="header">
	<td class="setCol_year"><b>Year</b></td>
	<td class="setCol_setResults"><b>Set</b></td>
	<td class="setCol_top_loader"><b>Top Loader</b></td>
	<td class="setCol_900"><b>900 Box</b></td>
	<td class="setCol_triple"><b>Triple Shoe</b></td>
	</tr>';
	//fetch and print all the records:
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
	{
	  echo '<tr class="table">
	  <td class="setCol_year">' . $row['year'] . '</td>
	  <td class="setCol_setResults">' . $row['set_name'] . '</td>
	  <td class="setCol_top_loader">' . $row['top_loader'] . '</td>
	  <td class="setCol_900">' . $row['nine_hundred'] . '</td>
	  <td class="setCol_triple">' . $row['triple_shoe'] . '</td>
	  </tr>';
	}
	echo '</table>'; // Close the table.	
	mysqli_free_result ($r); // Free up the resources.
}
else 
{// If it did not run OK.
	// Public message:
	echo '<p class="error">Error: The data you requested is unavailable. We apologize for any inconvenience.</p>';
	
	// Debugging message:
	echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
}
?>
</body>
<div>
<p></p>
<center><input name="Update" type="submit" class="medium blue button"
onclick="window.location.href='updatePageV2.php'" value="Update" /></center>
</div>
</html>