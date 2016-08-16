<?php
if(isset($_POST['email']))
{
	$email = sanitize_string($_POST['email']);
	$password = sanitize_string($_POST['pword']);
	//Connect to the TCFonlineStore dba_close
	require ('store_db2_connect.php');
	//Query the database to see if the email exists.
	$q = 'SELECT *
	  FROM $users
	  WHERE email=' . $email;
//Run the query.
$r = @mysqli_query ($dbc2, $q);
//If it runs okay, display the records.
	if($r){
	
	}
	else{
		//Print an error message.
		echo mysqli_error($dbc) . '<br>Query: ' . $q . '<br>';
		echo '<br>There was a problem finding what you requested.<br>';
	}
?>