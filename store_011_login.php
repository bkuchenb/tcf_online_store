<?php
//Include the head.
include ('store_000_head.php');
//Include the header.
include ('store_00_header.php');
if($_SERVER['REQUEST_METHOD'] == 'GET'){
	$choice = $_GET['choice'];
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	//Sanitize the user input.
	$email = sanitize_string($_POST['email']);
	$password = sanitize_string($_POST['password']);
	//Hide the sign in and log in buttons, display the logout button.
	echo'
		<script type="text/javascript">
			document.getElementById("signup_btn").type = "hidden";
			document.getElementById("login_btn").type = "hidden";
			document.getElementById("logout_btn").type = "submit";
		</script>';
}
echo'
<body>
	<div class="container_03">
		<div class="body_left">
		</div>
		<div class="body_center">
			<section id="sign_up_message">Please enter the following information to ' . strtolower($choice) . '.</section>
			<form method="POST" action="store_011_login.php">
				<div class="user_info_div">
					<section class="user_info">Email</section>
					<input class="user_info" name="email" id="email" type="text" />
					<section class="user_info">Password</section>
					<input class="user_info" name="password" id="password" type="password" />
				</div>
			</form>
		</div>
		<div class="body_right">
		</div>
	</div>
</body>
</html>';
?>