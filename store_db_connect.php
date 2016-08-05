<?php # Script 9.2 - mysqli_connect.php

// This file contains the database access information. 
// This file also establishes a connection to MySQL, 
// selects the database, and sets the encoding.

// Set the database access information as constants:
DEFINE ('DB_USER', 'invBaseball');
DEFINE ('DB_PASSWORD', 'R00thM!ck');
DEFINE ('DB_HOST', 'invBaseball.db.10393336.hostedresource.com');
DEFINE ('DB_NAME', 'invBaseball');

// Make the connection:
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

// Set the encoding...
mysqli_set_charset($dbc, 'utf8');