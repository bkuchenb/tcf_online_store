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
<style>
#bLetter {visibility: hidden;}
</style>
<div>
<center><button class="tcf_header" type="submit" onclick="window.location.href='sportPage.php'" /></center>
</div>
<body>
<p>
<form method="post" action="resultsPage.php" align="center">
<input name="choice3" type="submit" class="medium blue button" onclick="window.location.href='resultsPage.php'" value="A" />
<input name="choice3" type="submit" class="medium blue button" onclick="window.location.href='resultsPage.php'" value="B" />
<input name="choice3" type="submit" class="medium blue button" onclick="window.location.href='resultsPage.php'" value="C" />
<input name="choice3" type="submit" class="medium blue button" onclick="window.location.href='resultsPage.php'" value="D" />
<input name="choice3" type="submit" class="medium blue button" onclick="window.location.href='resultsPage.php'" value="E" />
<input name="choice3" type="submit" class="medium blue button" onclick="window.location.href='resultsPage.php'" value="F" />
<input name="choice3" type="submit" class="medium blue button" onclick="window.location.href='resultsPage.php'" value="G" />
</p>
<p>
<form method="post" action="resultsPage.php" align="center">
<input name="choice3" type="submit" class="medium blue button" onclick="window.location.href='resultsPage.php'" value="H" />
<input name="choice3" type="submit" class="medium blue button" onclick="window.location.href='resultsPage.php'" value="I" />
<input name="choice3" type="submit" class="medium blue button" onclick="window.location.href='resultsPage.php'" value="J" />
<input name="choice3" type="submit" class="medium blue button" onclick="window.location.href='resultsPage.php'" value="K" />
<input name="choice3" type="submit" class="medium blue button" onclick="window.location.href='resultsPage.php'" value="L" />
<input name="choice3" type="submit" class="medium blue button" onclick="window.location.href='resultsPage.php'" value="M" />
<input name="choice3" type="submit" class="medium blue button" onclick="window.location.href='resultsPage.php'" value="N" />
</p>
<p>
<form method="post" action="resultsPage.php" align="center">
<input name="choice3" type="submit" class="medium blue button" onclick="window.location.href='resultsPage.php'" value="O" />
<input name="choice3" type="submit" class="medium blue button" onclick="window.location.href='resultsPage.php'" value="P" />
<input name="choice3" type="submit" class="medium blue button" onclick="window.location.href='resultsPage.php'" value="Q" />
<input name="choice3" type="submit" class="medium blue button" onclick="window.location.href='resultsPage.php'" value="R" />
<input name="choice3" type="submit" class="medium blue button" onclick="window.location.href='resultsPage.php'" value="S" />
<input name="choice3" type="submit" class="medium blue button" onclick="window.location.href='resultsPage.php'" value="T" />
<input name="choice3" type="submit" class="medium blue button" onclick="window.location.href='resultsPage.php'" value="U" />
</p>
<p>
<form method="post" action="resultsPage.php" align="center">
<input name="choice3" type="submit" class="medium blue button" onclick="window.location.href='resultsPage.php'" value="V" />
<input name="choice3" type="submit" class="medium blue button" onclick="window.location.href='resultsPage.php'" value="W" />
<input name="choice3" type="submit" class="medium blue button" onclick="window.location.href='resultsPage.php'" value="X" />
<input name="choice3" type="submit" class="medium blue button" onclick="window.location.href='resultsPage.php'" value="Y" />
<input name="choice3" type="submit" class="medium blue button" onclick="window.location.href='resultsPage.php'" value="Z" />
<input id="bLetter" name="choice3" type="submit" class="medium blue button" onclick="window.location.href='resultsPage.php'"
value="L" />
<input name="choice3" type="submit" class="medium blue button" onclick="window.location.href='resultsPage.php'" value="%" />
</p>
</form>

<?php
$year = $_POST['choice2'];
$_SESSION['choice2'] = $year;
?>
</body>
</html>