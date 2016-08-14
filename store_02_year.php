<?php
//Start a session to save user input.
session_start();
//Include store functions.
include ('store_000_functions.php');
//Add the sport choosen to the session.
if(isset($_GET['sport']))
{
	$_SESSION['sport'] = $_GET['sport'];
}
//Create the header.
include ('store_00_header.php');
?>

<body>
	<div class="container_03">
		<div class="body_left">
		</div>
		<div class="body_center">
			<form method="get" action="store_03_letter.php" class="align_center">
<?php
//Create the year buttons.
create_year_buttons();
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