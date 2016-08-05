<?php
session_start();
//add the year choosen from the previous page to the SESSION array
if(isset($_GET['year']))
{
	$_SESSION['year'] = $_GET['year'];
}
//create the header
include ('store_00_header.php');
echo'
<body>
	<div class="container_03">
		<div class="body_left">
		</div>
		<div class="body_center">
			<form method="get" action="store_04_results.php" align="center">
				<p>';
					$counter = 0;//create a counter to put paragraph breaks between the rows
					$letters = range('A', 'Z');
					for($i = 0; $i < 26; $i++)
					{
						if($counter == 7)
						{
							$counter = 0;
							echo '</p><p>';
						}
						
						if($i <= 25)
						{echo '<input name="letter" type="submit" class="medium green button" value="' . $letters[$i] . '" />';}
						$counter++;
					}
						echo '
						<input name="letter" type="submit" class="medium green button btn_hidden" value="I" />
						<input name="letter" type="submit" class="medium green button" value="%" />
				</p>
			</form>
		</div>
		<div class="body_right">
		</div>
	</div>
</body>
<footer>
<div class="container_04">Icons made by <a href="http://www.flaticon.com/authors/stephen-hutchings" title="Stephen Hutchings">Stephen Hutchings</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
</footer>
</html>';
?>