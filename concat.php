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
	<title>Strings</title>
</head>
<body>
<?php
#Script 1.6 - strings.php
#Created November 24, 2015
#Created by Brendan Kuchenbecker

//Create the variables
$first_name = 'Brendan';
$last_name = 'Kuchenbecker';
$author = $first_name . ' ' . $last_name;
$book = 'War and Peace';

//Print the values:
echo "<p>The book <em>$book</em> was written by
 $author.</p>";

// End of PHP code.
?>
</body>
</html>