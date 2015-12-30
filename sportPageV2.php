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
	<link href="css/tcf_sport_buttons.css" rel="stylesheet">
	<title>TCF Overflow Inventory</title>
</head>
<?php
session_start();
?>
<style>
#hiddenB{visibility: hidden;}
</style>
<body>
<div>
<center><button class="tcf_header" type="submit" onclick="window.location.href='sportPageV2.php'" /></center>
</div>
<p>
<form method="get" action="yearPageV2.php" align="center">
<input name="sport" class="xlarge blue button" type="submit" value="Baseball" />
<input name="sport" class="xlarge blue button" type="submit" value="Football" />
<input name="sport" class="xlarge blue button" type="submit" value="Basketball" />
<input name="sport" class="xlarge blue button" type="submit" value="Hockey" />
</p>
<p>
<input name="sport" class="xlarge blue button" type="submit" value="Nonsports" />
<input name="sport" class="xlarge blue button" type="submit" value="Multisport" />
<input name="sport" class="xlarge blue button" type="submit" value="Racing" />
<input name="sport" class="xlarge blue button" type="submit" value="Wrestling" />
</p>
<p>
<input name="sport" class="xlarge blue button" type="submit" value="Soccer" />
<input name="sport" class="xlarge blue button" type="submit" value="Golf" />
<input name="sport" class="xlarge blue button" type="submit" value="Magic" />
<input name="sport" class="xlarge blue button" type="submit" value="YuGiOh" />
</p>
<p>
<input name="sport" class="xlarge blue button" type="submit" value="Pokemon" />
<input name="sport" class="xlarge blue button" type="submit" value="Gaming" />
<input name="sport" class="xlarge blue button" type="submit" value="Diecast" />
<input id="hiddenB" name="sport" class="xlarge blue button" type="submit" value="Diecast" />
</p></form>
</body>
</html>