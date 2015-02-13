<?php

//open html tags
echo '<!DOCTYPE html>
<html lang ="eng">
<meta charset="utf-8"/>
<head>
<title> php and mySQL </title>
</head>
<body>';

echo 'This is a test<br><br>';

?>

<?php

//db connection
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","leonardb-db","rYW5PXXTrTvbnJGI", "leonardb-db");

if(!$mysqli || $mysqli->connect_errno)
{
	echo "Connection error" . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

?>

<?php
echo '</body>
</html>';

?>
