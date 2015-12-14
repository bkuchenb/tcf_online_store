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
	<link href="css/tcf_buttons.css" rel="stylesheet">
	<link href="css/tcf_header.css" rel="stylesheet">
	<link href="css/tcf_background.css" rel="stylesheet">
	<title>TCF Overflow Inventory</title>
</head>
<?php
session_start();
?>
<body>
<div>
<center><button class="tcf_header" type="submit" onclick="window.location.href='sportPage.php'" /></center>
</div>
<p>
<form method="post" action="yearPage.php" align="center">
<input name="choice" class="xlarge blue button" type="submit" value="Baseball" onclick="window.location.href='yearPage.php'" />
<input name="choice" class="xlarge blue button" type="submit" value="Football" onclick="window.location.href='yearPage.php'" />
<input name="choice" class="xlarge blue button" type="submit" value="Basketball" onclick="window.location.href='yearPage.php'" />
<input name="choice" class="xlarge blue button" type="submit" value="Hockey" onclick="window.location.href='yearPage.php'" />
</form>
</p>
<p>
<form method="post" action="yearPage.php" align="center">
<input name="choice" class="xlarge blue button" type="submit" value="Non-Sport" onclick="window.location.href='yearPage.php'" />
<input name="choice" class="xlarge blue button" type="submit" value="Multisports" onclick="window.location.href='yearPage.php'" />
<input name="choice" class="xlarge blue button" type="submit" value="Racing" onclick="window.location.href='yearPage.php'" />
<input name="choice" class="xlarge blue button" type="submit" value="Wrestling" onclick="window.location.href='yearPage.php'" />
</form>
</p>
</body>
</html>