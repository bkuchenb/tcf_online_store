<?php
//Include the head.
include ('store_000_head.php');
//Include the header.
include ('store_00_header.php');
if($_SERVER['REQUEST_METHOD'] == 'GET'){
	$choice = $_GET['choice'];
	$_SESSION['choice'] = $choice;
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	//Connect to the TCFonlineStore database.
	require ('store_db2_connect.php');
	//Get the choice the user made.
	$choice = $_SESSION['choice'];
	//Sanitize the user input.
	$email = sanitize_string($_POST['email']);
	$password = SHA1(sanitize_string($_POST['password']));
	$first_name = sanitize_string($_POST['first_name']);
	$last_name = sanitize_string($_POST['last_name']);
	//Add slashes to the variables.
	$email = mysqli_real_escape_string($dbc2, $email);
	$password = mysqli_real_escape_string($dbc2, $password);
	//Validate the email.
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$valid_email = false; 
	}
	else{
		//Query the database to see if the email exists.
		$q = 'SELECT *
		  FROM Users
		  WHERE email="' . $email . '"
		  LIMIT 1';
		//Run the query.
		$r = mysqli_query($dbc2, $q);
		//If it runs okay, return the value.
		if($r){
			//Fetch the results.
			while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
				//Save the user info.
				$user_info = $row;
				//If the email was found check to see if the password matches.
				if(isset($row['email'])){
					$_SESSION['email_found'] = true;
					//If the password matches log the user in.
					if(SHA1($row['password']) == $password){
						$_SESSION['password_found'] = true;
					}
					else{
						$_SESSION['password_found'] = false;
					}
				}
				else{
					$_SESSION['email_found'] = false;
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
	//Process the user request.
	//If login was clicked and the password is correct log the user in.
	if($choice == 'Log in' && $_SESSION['email_found'] == true
		&& $_SESSION['password_found'] == true){
			$_SESSION['logged_in'] = true;
			$_SESSION['user_info'] = $user_info;
	}
	//If sign up was clicked add the user to the database.
	elseif($choice == 'Sign up' && $_SESSION['email_found'] == false){
		//Add the email and password to the database.
		$q = 'INSERT INTO Users(email, password, first_name, last_name, user_type)
			  VALUES("' . $email . '","' . $password . '","' . $first_name . '","' . $last_name .'", "guest")';
		//Run the query.
		$r = mysqli_query ($dbc2, $q);
		if($r){
			$_SESSION['logged_in'] = true;
		}
		else{
			//Print an error message.
			echo mysqli_error($dbc) . '<br>Query: ' . $q . '<br>';
			echo '<br>There was a problem finding what you requested.<br>';
		}
	}
}
echo'
<body>
	<div class="container_03">
		<div class="body_left">
		</div>
		<div class="body_center">';
if(!isset($_SESSION['logged_in'])){
	echo'
			<section id="opening_message">Please enter the following information to ' . strtolower($choice) . '.</section>
			<form method="POST" action="store_011_login.php">
				<div class="user_info_div">
					<section class="user_info">First Name</section>
					<input class="user_info" name="first_name" id="first_name" type="text" />
					<section class="user_info">Last Name</section>
					<input class="user_info" name="last_name" id="last_name" type="text" />
					<section class="user_info">Email</section>
					<input class="user_info" name="email" id="email" type="text" />
					<section class="user_info">Password</section>
					<input class="user_info" name="password" id="password" type="password" />
					<section class="user_info">
					<input type="submit" value="Submit" /></section>';
}
else{
	echo'
		<section id="opening_message">Welcome back ' . strtoupper($_SESSION['user_info']['first_name']) . '.</section>';
	
}
echo'
				</div>
			</form>
		</div>
		<div class="body_right">
		</div>
	</div>
<script type="text/javascript" src="store_002_scripts_login.js"></script>
</body>
</html>';
?>