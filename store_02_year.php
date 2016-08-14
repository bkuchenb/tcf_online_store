<?php
//Create the header.
include ('store_00_header.php');
//Add the sport choosen to the session.
if(isset($_GET['sport'])){
	$_SESSION['sport'] = $_GET['sport'];
}
echo'
<body>
	<div class="container_03">
		<div class="body_left">
		</div>
		<div class="body_center">
			<form method="get" action="store_03_letter.php" class="align_center">';
//Create the year buttons.
create_year_buttons();
echo'
			</form>
		</div>
		<div class="body_right">
		</div>
	</div>
</body>
</html>';
?>