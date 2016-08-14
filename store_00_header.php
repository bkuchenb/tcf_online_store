<?php
echo'
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
			<button class="logo" type="submit" onclick="window.location.href=\'store_01_sport.php\'"></button>
		</div>
		<div class="header_right">
			<div class="header_row">';
if(isset($_SESSION['cart'])){
	echo'
				<b>Items in Cart: (' . count($_SESSION['cart']) . ')</b>'; 
} 
else{
	echo'
				<b>Items in Cart: (0)</b>';
}
echo'
			</div>
			<div class="header_row">
				<button class="cart" type="submit" onclick="window.location.href=\'store_06_cart.php\'"></button>
			</div>';
if(isset($_SESSION['cart'])){
	echo'
				<div class="header_row">
					<form method="GET" action="store_01_sport.php">
						<input name="empty" type="submit" value="Empty Cart" />
					</form>
				</div>';
}
echo'
			</div>
		</div>
	</div>
	<div class="container_02">
        <div class="navbar_left">
			<button class="navbar_button" id="signup_btn" type="submit"
				onclick="window.location.href=\'store_011_login.php\'">Sign up</button>
			<button class="navbar_button" id="login_btn" type="submit"
				onclick="window.location.href=\'store_011_login.php\'">Log in</button>
			<button class="navbar_button" id="logout_btn" type="submit">Log out</button>
        </div>
		<nav class="navbar" id="navcontainer">
			<ul>
				<li><a href="store_01_sport.php">' . $_SESSION['sport'] . '</a></li>
				<li><a href="store_02_year.php">' . $_SESSION['year'] . '</a></li> 
				<li><a href="store_03_letter.php">' . $_SESSION['letterClicked'] . '</a></li>';
if($_SESSION['set_name'] != ''){
	echo'
				<li><a href="store_05_view.php">' . $_SESSION['year'] . ' ' . $_SESSION['set_name'] . '</a></li>';
}
echo'
			</ul>
		</nav>
        <div class="navbar_right">
        </div>
	</div>
</header>';
?>