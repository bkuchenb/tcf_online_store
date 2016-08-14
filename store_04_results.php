<?php
//Start a session to save user input.
session_start();
//Include the store_000_head.html file.
include ('store_000_head.html');
//Get the letter clicked on the last page.
if(isset($_GET['letter'])){
	$_SESSION['letterClicked'] = $_GET['letter'];
}
//Check to see what letter was choosen.
//Format the $letter variable accordingly.
if($_GET['letter'] == '%'){
	//If % was selected return all sets in inventory for the given year.
	$letter = '\''. $_GET['letter']. '\'';
}
//If any other letter was selected, return all sets that begin with that letter.
else{
	$letter = '\''. $_GET['letter']. '%\'';
}
//Add the letter to the session.
$_SESSION['letter'] = $letter;
//Add the sport and year choosen to local variables.
$sport = $_SESSION['sport'];
if($_SESSION['year'] == '%'){
	$year = '\'' . $_SESSION['year'] . '\'';
}
else{
	$year = $_SESSION['year'];
}
//Build the table name from the choosen sport.
$set_list_table = 'set_list_' . strtolower($sport);
//Add the set_list_table to the session.
$_SESSION['set_list_table'] = $set_list_table;
//Include store functions.
include ('store_000_functions.php');
//Create the header.
include ('store_00_header.php');
//Connect to the correct database database.
require ('store_db_connect.php');	
//Query the database.
$q = "SELECT year, set_name, table_name
      FROM $set_list_table
	  WHERE year=$year AND active >= 0 AND set_name LIKE $letter ORDER BY year ASC, set_name ASC";
//Run the query.
$r = @mysqli_query ($dbc, $q);
//If it runs okay, display the records.
if ($r){
?>

<body>
	<div class="container_03">
		<div class="body_left">
		</div>
		<div class="body_center">
			<div class="body_header">
				<div class="body_header_cards" style="width:100px;">Year</div>
				<div class="body_header_cards" style="width:335px;">Set</div>
				<div class="body_header_cards" style="width:145px;">View Cards</div>
			</div>
			<form method="POST" action="store_05_view.php">
<?php
	//Create an array to store the results of the query.
	$resultsArray = array();
	//Create and initailize the counter.
	$counter = 0;
	//Fetch, and add all the records to the results array.
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
		//Add the row to the resultsArray.
		$resultsArray[$counter] = $row;	  
		//Update the counter.
		$counter++;		 
	}
	//Add the results array to the session array.
	$_SESSION['array'] = $resultsArray;
	//Display the results.
	for($i=0; $i < count($resultsArray); $i++){
?>
				<div class="body_table">
					<div class="body_table_cards" style="width:100px;"><?php echo $resultsArray[$i]['year']; ?></div>
					<div class="body_table_cards" style="width:335px;"><?php echo $resultsArray[$i]['set_name']; ?></div>
					<div class="div_button_view">
						<input name="<?php echo $resultsArray[$i]['set_name']; ?>" style="width:145px;" type="submit" value="View" />
						<input name="<?php echo $resultsArray[$i]['table_name']; ?>" style="width:145px;" type="hidden" value="Hidden" />							
					</div>
				</div>
<?php
	}
	//Free up the resources.
	mysqli_free_result ($r);
}
else{
	//Print an error message.
	echo mysqli_error($dbc) . '<br>Query: ' . $q . '<br>';
	echo '<br>There was a problem finding what you requested.<br>';
}
?>
			</form>
		</div>
		<div class="body_right">
		</div>
	</div>
</body>
<footer>
	<div class="container_04">
		<div>Icons made by 
			<a href="http://www.flaticon.com/authors/stephen-hutchings" title="Stephen Hutchings">Stephen Hutchings</a>
			from 
			<a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a>
			is licensed by 
			<a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 B</a>
		</div>
	</div>
</footer>
</html>