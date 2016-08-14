<?php
//Create the header.
include ('store_00_header.php');
//Add the year choosen to the session.
if(isset($_GET['year'])){
	$_SESSION['year'] = $_GET['year'];
}
echo'
<body>
	<div class="container_03">
		<div class="body_left">
		</div>
		<div class="body_center">
			<form method="get" action="store_04_results.php" class="align_center">';
//Create the letter buttons.
create_letter_buttons();	
echo'
			</form>
		</div>
		<div class="body_right">
		</div>
	</div>
</body>
</html>';
?>