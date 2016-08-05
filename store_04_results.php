<?php
session_start();
//Get the letter clicked on the last page.
if(isset($_GET['letter']))
	{
		$_SESSION['letterClicked'] = $_GET['letter'];
	}
//Check to see what letter was choosen on the previous page
//and format the $letter variable accordingly.
if($_GET['letter'] == '%')
{
	//If % was selected return all sets in inventory for the given year.
	$letter = '\''. $_GET['letter']. '\'';
}
//If any other letter was selected, return all sets that begin with that letter.
else
{
	$letter = '\''. $_GET['letter']. '%\'';
} 
$_SESSION['letter'] = $letter;

//Add the sport and year choosen to local variables.
$sport = $_SESSION['sport'];
if($_SESSION['year'] == '%')
{
	$year = '\'' . $_SESSION['year'] . '\'';
}
else
{
	$year = $_SESSION['year'];
}
//Build the table name from the choosen sport.
$set_list_table = 'set_list_' . strtolower($sport);
$_SESSION['set_list_table'] = $set_list_table;
//Connect to the correct database database.
require ('store_db_connect.php');	
//Query the database.
$q = "SELECT year, set_name, table_name
      FROM $set_list_table
	  WHERE year=$year AND active >= 0 AND set_name LIKE $letter ORDER BY year ASC, set_name ASC";
//Run the query.
$r = @mysqli_query ($dbc, $q);
//If it runs ok, display the records.
if ($r)
{
	//Create the header and table.
	include ('store_00_header.php');
	echo '<body>
			<div class="container_03">
				<div class="body_left">
				</div>
				<div class="body_center">
					<div class="body_table_header">
						<table class="table_sets">
							<thead>
								<tr class="table_sets_row_header">
									<th class="table_cell_150">Year</th>
									<th class="table_cell_450">Set</th>
									<th class="table_cell_150">View Cards</th>
								</tr>
							</thead>
						</table>
					</div>
					<div class="body_table">
						<table class="table_sets">
							<tbody>
								<form method="POST" action="store_05_view.php">';
	//Create a 2 dimmensional array to store the results of the query
	$resultsArray = array();
	$resultsRow = array();
	//Create and initailize the counter
	$counter = 0;
	//Fetch, and add all the records to the results array.
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
	{
		$resultsRow[0] = $row['table_name'];
		$resultsRow[1] = $row['year'];
	    $resultsRow[2] = $row['set_name'];
		//Add the resultsRow array to the resultsArray.
		$resultsArray[$counter] = $resultsRow;	  
		//Update the counter.
		$counter++;		 
	}
	//Add the results array to the session array.
	$_SESSION['array'] = $resultsArray;
	//Display the results.
	for($i=0; $i < count($resultsArray); $i++)
	{
		echo '<tr class="table_sets_row">
				<td class="table_cell_150">' . $resultsArray[$i][1] . '</td>
				<td class="table_cell_450">' . $resultsArray[$i][2] . '</td>
				<td class="table_cell_150 table_sets_cell_view"><input class="btn_view"
					name="' . $resultsArray[$i][2] . '" type="submit" value="View" /></td>
			</tr>
			<input name="' . $resultsArray[$i][0] . '" type="hidden" value="id" />';
	}
	mysqli_free_result ($r); // Free up the resources.
}
else//it did not run OK
{
	// Error message:
	echo mysqli_error($dbc) . '<br>Query: ' . $q . '<br>';
	echo '<br>There was a problem finding what you requested.<br>';
}
echo'
						</form>
					</tbody>
				</table>
			</div>
		</div>
		<div class="body_right">
		</div>
	</div>
</body>
<footer>
<div class="container_04">Icons made by <a href="http://www.flaticon.com/authors/stephen-hutchings" title="Stephen Hutchings">Stephen Hutchings</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
</footer>
</html>';
?>