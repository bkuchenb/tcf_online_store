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

		//table header
		echo '<table>
		<tr class="header">
		<td class="setCol_year"><b>Year</b></td>
		<td class="setCol_setPage"><b>Set</b></td>
		<td class="setCol_setPage"><b>Click a button to view the individual cards.</b></td>
		</tr>';
		
	for($i=0; $i < count($_SESSION['array']); $i++)
	{
		echo '<form method="post" action="detailsPageV2.php">
		<tr class="table">
		<td class="setCol_year">' . $_SESSION['array'][$i][1] . '</td>
		<td class="setCol_setPage">' . $_SESSION['array'][$i][2] . '</td>
		<td id="matchBackground"><input class="setButton_100" name="update" type="submit" 
			value="' . $_SESSION['array'][$i][1] . '_' . $_SESSION['array'][$i][2] . '" /></td>
		</tr>';
	}//end of for loop

	echo '</table></form>'; // Close the table and form
?>
</body>
</html>