<?php
echo'
<!DOCTYPE html>
<html lang="en-US">
<head>
	<title>TCF Online Store</title>
	<meta charset="utf-8" />
	
	<link type="text/css" href="css/store.css" rel="stylesheet"
        media="screen and (min-device-width: 1225px)"/>
	<link type="text/css" href="css/buttons.css" rel="stylesheet" />
	<link type="text/css" href="css/table.css" rel="stylesheet" />
</head>
<header>
	<div class="container_01">
		<div class="header_left">
			<b>Contact Information:</b>
			<p></p>
			<a href="mailto:mickeybuysgold@gmail.com">mickeybuysgold@gmail.com</a>
			<br>470 North Greenbush Road
			<br>Rensselaer, New York 12144
			<br>(518) 283-3818
		</div>
		<div class="header_center">
			<button class="logo" type="submit" onclick="window.location.href=\'store_01_sport.php\'" />
		</div>
		<div class="header_right">
		<b>';
        if(isset($_SESSION['cart']))
		{
            echo 'Items in Cart: (' . count($_SESSION['cart']) . ')';
        }
		else
		{
			echo 'Items in Cart: (0)';
			$_SESSION['cart'] = array();
		}
        echo'
        </b>
		<p></p>
		<button class="cart" type="submit" onclick="window.location.href=\'store_06_cart.php\'" />
		</div>
	</div>
	<div class="container_02">
        <div class="navbar_left">
        </div>
		<nav class="navbar" id="navcontainer">
			<ul>
			  <li><a href="store_01_sport.php">' . $_SESSION['sport'] . '</a></li>
			  <li><a href="store_02_year.php">' . $_SESSION['year'] . '</a></li> 
			  <li><a href="store_03_letter.php">' . $_SESSION['letterClicked'] . '</a></li>
			  <li>' . $_SESSION['set'] . '</li>
			</ul>
		</nav>
        <div class="navbar_right">
        </div>
	</div>
</header>';
?>