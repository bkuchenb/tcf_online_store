<?php
//Start a session to save data.
session_start();
if(isset($_POST['email']))
{
	//Sanitize the user input.
	$email = sanitize_string($_POST['email']);
	$password = SHA1(sanitize_string($_POST['pword']));
	//Validate the email.
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		echo 'Invalid email format'; 
	}
	else{
		//Connect to the TCFonlineStore dba_close
		require ('store_db2_connect.php');
		//Query the database to see if the email exists.
		$q = 'SELECT *
		  FROM Users
		  WHERE email=' . $email . '
		  LIMTIT = 1';
		//Run the query.
		$r = @mysqli_query ($dbc2, $q);
		//If it runs okay, return the value.
		if($r){
			//Fetch the results.
			while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
				//If the email was found check to see if the password matches.
				if(isset($row['email']){
					//If the password matches return a welcome message.
					if(SHA1($row['password']) == $password){
						echo $row;
					}
					else{
						echo 'password';
					}
				}
				else{
					//Add the email to the database.
					$q = 'INSERT INTO Users(email, password)
						  VALUES($email, $password)';
					//Run the query.
					$r = @mysqli_query ($dbc2, $q);
					if($r){
						echo 'added'
					}
					else{
						//Print an error message.
						echo mysqli_error($dbc) . '<br>Query: ' . $q . '<br>';
						echo '<br>There was a problem finding what you requested.<br>';
					}
				}
			}
			//Free up the resources.
			mysqli_free_result ($r); 
		}
		else{
			//Print an error message.
			echo mysqli_error($dbc) . '<br>Query: ' . $q . '<br>';
			echo '<br>There was a problem finding what you requested.<br>';
		}
	}
}	
?>