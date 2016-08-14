<?php
//Create the header.
include ('store_00_header.php');
//Empty the cart if the button was clicked.
if(isset($_GET['empty'])){
	$_SESSION['cart'] = array();
}
//Initialize the variables that the user will choose.
$_SESSION['sport'] = '';
$_SESSION['year'] = '';
$_SESSION['letterClicked'] = '';
$_SESSION['set_name'] = '';
echo'
<body>
	<div class="container_03">
		<div class="body_left">
		</div>
		<div class="body_center">
			<form method="get" action="store_02_year.php" class="align_center">';
//Create the sport buttons.
create_sport_buttons();
echo'
			</form>
		</div>
		<div class="body_right">
		</div>
	</div>
</body>
</html>';
?>