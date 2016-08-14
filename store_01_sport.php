<?php
//Force the browser to clear the shopping cart when it closes.
session_set_cookie_params(0);
//Start a session to save user input.
session_start();
//Include the store_000_head.html file.
include ('store_000_head.html');
//Include store functions.
include ('store_000_functions.php');
//Empty the cart if the button was clicked.
if(isset($_GET['empty'])){
	$_SESSION['cart'] = array();
}
//Initialize the variables that the user will choose.
$_SESSION['sport'] = '';
$_SESSION['year'] = '';
$_SESSION['letterClicked'] = '';
$_SESSION['set_name'] = '';
//Create the header.
include ('store_00_header.php');
?>

<body>
	<div class="container_03">
		<div class="body_left">
		</div>
		<div class="body_center">
			<form method="get" action="store_02_year.php" class="align_center">
<?php
//Create the sport buttons.
create_sport_buttons();
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