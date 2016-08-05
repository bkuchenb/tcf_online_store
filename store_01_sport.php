<?php
session_set_cookie_params(0);
session_start();
$_SESSION['sport'] = '';
$_SESSION['year'] = '';
$_SESSION['letterClicked'] = '';
$_SESSION['set'] = '';
//create the header
include ('store_00_header.php');
echo'
<body>
	<div class="container_03">
		<div class="body_left">
		</div>
		<div class="body_center">
			<form method="get" action="store_02_year.php" align="center">
				<p>
					<input name="sport" class="xlarge green button" type="submit" value="Baseball" />
					<input name="sport" class="xlarge green button" type="submit" value="Football" />
					<input name="sport" class="xlarge green button" type="submit" value="Basketball" />
					<input name="sport" class="xlarge green button" type="submit" value="Hockey" />
				</p>
				<p>
					<input name="sport" class="xlarge green button" type="submit" value="Nonsports" />
					<input name="sport" class="xlarge green button" type="submit" value="Multisport" />
					<input name="sport" class="xlarge green button" type="submit" value="Racing" />
					<input name="sport" class="xlarge green button" type="submit" value="Wrestling" />
				</p>
				<p>
					<input name="sport" class="xlarge green button" type="submit" value="Soccer" />
					<input name="sport" class="xlarge green button" type="submit" value="Golf" />
					<input name="sport" class="xlarge green button" type="submit" value="Magic" />
					<input name="sport" class="xlarge green button" type="submit" value="YuGiOh" />
				</p>
				<p>
					<input name="sport" class="xlarge green button" type="submit" value="Pokemon" />
					<input name="sport" class="xlarge green button" type="submit" value="Gaming" />
					<input name="sport" class="xlarge green button" type="submit" value="Diecast" />
					<input name="sport" class="xlarge green button btn_hidden" type="submit" value="Diecast" />
				</p>
			</form>
		</div>
		<div class="body_right">
		</div>
	</div>
</body>
<footer>
<div class="container_04">
	<div>Icons made by <a href="http://www.flaticon.com/authors/stephen-hutchings" title="Stephen Hutchings">Stephen Hutchings</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
</div>
</footer>
</html>';
?>