<?php
session_start();
if(isset($_POST['view']))
{
	if($_POST['view'] == 'front')
	{
		echo $_SESSION['array'][$_POST['index']]['img_back'];
	}
	else
	{
		echo $_SESSION['array'][$_POST['index']]['img_front'];
	}
	
}
?>