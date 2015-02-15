<?php

//open html tags
echo '<!DOCTYPE html>
<html lang ="eng">
<meta charset="utf-8"/>
<head>
<title> php and mySQL </title>
</head>
<body>';

echo 'This is a test<br><br><hr><br>';

?>

<?php 
//form html

echo '	<form action="upload.php" method="GET">
		<legend> <ADD A VIDEO </legend><br>
		Name: <input type="text" name="name"><br>
		Category: <input type="text" name="category"><br>
		Length: <input type="text" name="length"><br>
		<input type="submit" value="Add Video">
		</form><br> <hr> <br>';


?>

<?php

//db connection
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","leonardb-db","rYW5PXXTrTvbnJGI", "leonardb-db");

if(!$mysqli || $mysqli->connect_errno)
{
	echo "Connection error" . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if (!($stmt = $mysqli->prepare("SELECT name, category, length, rented FROM videoInventory")))
{
	echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

/*if (!$stmt->bind_param("ssi", $newName, $newCategory, $newLength))
{
	echo "Binding parameters failed: (" . $stmt-errno . ") " . $stmt->error;
}*/

if (!$stmt->execute())
{
	echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}

$resultName = null;
$resultCategory = null;
$resultLength = null;
$resultRented = null;

$stmt->bind_result($resultName, $resultCategory, $resultLength, $resultRented);

echo '<table border="1">
		<tr><th> Name <th> Category <th> Length <th> Rented <th> Rent <th> Delete';

while($stmt->fetch())
{
	if($resultRented == 1)
	{
		$resultRented = 'checked out';
	}
	else
	{
		$resultRented = "available";
	}
	echo '<tr><td>' . $resultName . '<td>' . $resultCategory . '<td>'
	. $resultLength . '<td>' . $resultRented . '<td><form method="GET" action="upload.php"><input type="hidden" name="rentName" value ="' . $resultName . '"><input type="submit" value="Rent / Return"></form>'
	. '<td><form method="GET" action="upload.php"> <input type="hidden" name="delName" value ="' . $resultName .'"> <input type="submit" value="Delete"></form>';
}

echo '</table>';

$stmt->close();

?>

<?php
echo '</body>
</html>';

?>
