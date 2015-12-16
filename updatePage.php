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
	<title>TCF Overflow Inventory</title>
</head>
<?php
session_start();
?>
<div>
<center><button class="tcf_header" type="submit" onclick="window.location.href='sportPage.php'" /></center>
</div>
<body>
<?php
$sport = $_SESSION['choice'];
$year = $_SESSION['choice2'];
$letter = $_SESSION['choice3'];

//connect to the db
require ('mysqli_connect.php');
		
//make the query:
$q = "SELECT year, set_name, top_loader, nine_hundred, triple_shoe
      FROM $sport
	  WHERE year = $year AND top_loader > 0 AND set_name LIKE $letter";
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
	<td class="tcf_table_header" align="left"><b>Top Loader</b></td>
	<td class="tcf_table_header" align="left"><b>900 Box</b></td>
	<td class="tcf_table_header" align="left"><b>Triple Shoe</b></td>
	</tr>';
 //fetch and print all the records:
  while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
  {
	  echo '<form method="post">
	  <tr><td class="tcf_table" align="left">' . $row['year'] . '</td>
	  <td class="tcf_table" align="left">' . $row['set_name'] . '</td>
	  <td><input id="tl_update" type="text" class="tcf_table" align="left" value="' . $row['top_loader'] . '"</td>
	  <td><input id="nh_update" type="text" class="tcf_table" align="left" value="' . $row['nine_hundred'] . '"</td>
	  <td><input id="ts_update" type="text" class="tcf_table" align="left" value="' . $row['triple_shoe'] . '"</td>
	  </tr>';
	}
echo '</table><form>'; // Close the table.
	
	mysqli_free_result ($r); // Free up the resources.	

} else { // If it did not run OK.

	// Public message:
	echo '<p class="error">The current users could not be retrieved. We apologize for any inconvenience.</p>';
	
	// Debugging message:
	echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
}

?>
</body>
<div>
<p></p>
<center><input name="Submit" type="submit" class="medium blue button"
onclick="window.location.href='updatePage.php'" value="Sumbit" /></center>
</div>
</html>