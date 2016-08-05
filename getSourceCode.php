<?php
$homepage = file_get_contents('');
$outfile = "sourceCode.html";
file_put_contents($outfile, $homepage);
?>