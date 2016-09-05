<?php
//Start a session to access saved data.
session_start();
//Include store functions.
include ('store_000_functions.php');
//Get data that was added to the Session.
$set_list_table = $_SESSION['set_list_table'];
$sport = $_SESSION['sport'];
$year = $_SESSION['year'];
$set_table = $_SESSION['set_table'];
$set_name = $_SESSION['set_name'];

//Connect to the correct database.
require ('store_db_connect.php');
//Get set_id.
$q = 'SELECT *
	  FROM ' . $set_list_table . '
	  WHERE table_name = "' . $set_table . '"
	  LIMIT 1';
//Run the query.
$r = mysqli_query($dbc, $q);
//If it runs okay, display the records.
if($r){
	$row = mysqli_fetch_array($r, MYSQLI_ASSOC);
}
else{
	//Print an error message.
	echo mysqli_error($dbc) . '<br>Query: ' . $q . '<br>';
	echo '<br>There was a problem finding what you requested.<br>';
}

//Update the information that was changed.
if(isset($_POST)){
	//Build the query.
	$q = 'UPDATE ' . $set_table . ' SET(';
	//Create a variable to store the values.
	$values = 'VALUES(';
	//Update the quantity to add to the database.
	if(isset($_POST['add'])){
		//Sanitize the data.
		$add = sanitize_string($_POST['add']);
		$qty = (int)$add + (int)$_POST['qty'];
		$q = $q . 'quantity, ';
		$values = $values . '"' . (string)$qty . '", ';
		
	}
	if(isset($_POST['cond'])){
		//Sanitize the data.
		$cond = sanitize_string($_POST['cond']);
		//Add to the query string.
		$q = $q . 'cond, ';
		$values = $values . '"' . $cond . '", ';
	}
	if(isset($_POST['cond_price'])){
		//Sanitize the data.
		$cond_price = (float)sanitize_string($_POST['cond_price']);
		//Add to the query string.
		$q = $q . 'cond_price, ';
		$values = $values . '"' . $cond_price . '", ';
	}
	if(isset($_FILES['file_front'])){
		//Add to the query string.
		$q = $q . 'img_front, ';
		$values = $values . '"images/' . strtolower($sport) . '/' . $row['id'] . '/' . $_FILES['file_front']['name'] . '", ';
		//Save the file in the correct folder.
		file_put_contents('images/' . strtolower($sport) . '/' . $row['id'] . '/' . $_FILES['file_front']['name'],
		file_get_contents($_FILES['file_front']['tmp_name']));
	}
	if(isset($_FILES['file_back'])){
		//Add to the query string.
		$q = $q . 'img_back, ';
		$values = $values . '"images/' . strtolower($sport) . '/' . $row['id'] . '/' . $_FILES['file_back']['name'] . '", ';
		//Save the file in the correct folder.
		file_put_contents('images/' . strtolower($sport) . '/' . $row['id'] . '/' . $_FILES['file_back']['name'],
		file_get_contents($_FILES['file_back']['tmp_name']));
	}
	//Finish the query string.
	$q = rtrim($q, ', ') . ') ' . rtrim($values, ', ') . ') WHERE card_id = ' . $_POST['card_id'];
	//Run the query.
	$r = mysqli_query($dbc, $q);
	//If it runs okay, echo test message.
	if($r){
		echo $q;
	}
	else{
		//Print an error message.
		echo mysqli_error($dbc) . '<br>Query: ' . $q . '<br>';
		echo '<br>There was a problem finding what you requested.<br>';
	}
	echo true;
}
else{
	echo false;
}
?>