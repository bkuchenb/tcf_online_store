<!DOCTYPE html>
<html lang="en-US">
<head>
	<title>TCF Online Store</title>
	<meta charset="utf-8" />
	<link type="text/css" href="css/store.css" rel="stylesheet" media="screen" />
	<link type="text/css" href="css/buttons.css" rel="stylesheet" />
	<link type="text/css" href="css/table.css" rel="stylesheet" />
</head>
<header>
	<div class="container_01">
		<div class="header_left">
			<div class="header_row">
				<b>Contact Information:</b>
			</div>
			<div class="header_row">
				<a href="mailto:mickeybuysgold@gmail.com">mickeybuysgold@gmail.com</a>
				<br>470 North Greenbush Road
				<br>Rensselaer, New York 12144
				<br>(518) 283-3818
			</div>
		</div>
		<div class="header_center">
			<button class="logo" type="submit" onclick="window.location.href='store_01_sport.php'"></button>
		</div>
		<div class="header_right">
			<div class="header_row">
<?php 
if(isset($_SESSION['cart'])){
?>
				<b>Items in Cart: (<?php echo count($_SESSION['cart']) ?>)</b>
<?php } 
else{ 
?>
				<b>Items in Cart: (0)</b>';
<?php
}
?>
			</div>
			<div class="header_row">
				<button class="cart" type="submit" onclick="window.location.href='store_06_cart.php'"></button>
			</div>
<?php
if(isset($_SESSION['cart'])){
?>
				<div class="header_row">
					<form method="GET" action="store_01_sport.php">
						<input name="empty" type="submit" value="Empty Cart" />
					</form>
				</div>
<?php
}
?>
			</div>
		</div>
	</div>
	<div class="container_02">
        <div class="navbar_left">
			<button class="navbar_button" id="signup_btn" type="submit"
				onclick="window.location.href='store_011_login.php'">Sign up</button>
			<button class="navbar_button" id="login_btn" type="submit"
				onclick="window.location.href='store_011_login.php'">Log in</button>
			<button class="navbar_button" id="logout_btn" type="submit">Log out</button>
        </div>
		<nav class="navbar" id="navcontainer">
			<ul>
				<li><a href="store_01_sport.php"><?php echo $_SESSION['sport'] ?></a></li>
				<li><a href="store_02_year.php"><?php echo $_SESSION['year'] ?></a></li> 
				<li><a href="store_03_letter.php"><?php echo $_SESSION['letterClicked'] ?></a></li>
<?php
if($_SESSION['set_name'] != ''){
?>
				<li><a href="store_05_view.php"><?php echo $_SESSION['year'] . ' ' . $_SESSION['set_name'] ?></a></li>
<?php
}
?>
			</ul>
		</nav>
        <div class="navbar_right">
        </div>
	</div>
</header>