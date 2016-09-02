<?php
//Save the image.
if(isset($_FILES)){
	file_put_contents('images/bb_1960_Topps/' . $_FILES['image']['name'],
	file_get_contents($_FILES['image']['tmp_name']));
	echo true;
}
else{
	echo false;
}
?>