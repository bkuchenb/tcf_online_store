<!DOCTYPE html PUBLIC "-//W3C//
DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/
xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/
1999/xhtml" xml:lang="en"
lang="en">
<head>
	<meta http-equiv="Content-Type"
	content="text/html;
	charset=utf-8"  />
	<link href="css/tcf_header.css" rel="stylesheet">
	<link href="css/tcf_background.css" rel="stylesheet">
	<link href="css/tcf_letter_buttons.css" rel="stylesheet">
	<title>TCF Overflow Inventory</title>
</head>
<?php
session_start();
?>
<style>
#hiddenB {visibility: hidden;}
</style>
<div class="freeze">
<button class="tcf_header" type="submit" onclick="window.location.href='sportPageV2.php'" />
</div>
<body>
<p>
<form method="get" action="resultsPageV2.php" align="center">
<?php
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
	{echo '<input name="letter" type="submit" class="medium blue button" value="' . $letters[$i] . '" />';}
	$counter++;
}
	echo '<input id="hiddenB" name="letter" type="submit" class="medium blue button" value="I" />';
	echo '<input name="letter" type="submit" class="medium blue button" value="%" /></p></form>';


//add the year choosen from the previous page to the SESSION array
$_SESSION['year'] = $_GET['year'];
?>
</body>
</html>