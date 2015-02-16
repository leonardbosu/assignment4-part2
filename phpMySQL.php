<?php

//open html tags
echo '<!DOCTYPE html>
<html lang ="eng">
<meta charset="utf-8"/>
<head>
<title> php and mySQL </title>
</head>
<body>';

echo 'Video Inventory<br><br><hr><br>';

?>

<?php 
//html tags for add video form

echo '	<form action="upload.php" method="GET">
		Name: <input type="text" name="name"><br>
		Category: <input type="text" name="category"><br>
		Length: <input type="text" name="length"><br>
		<input type="submit" value="Add Video">
		</form><br><br> <hr> <br>';


?>

<?php
//filter variable
if ($_GET["filter"] != null)
{
	$setFilter = $_GET["filter"];
}
else
{
	$setFilter = "ALL";
}





//open db connection
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","leonardb-db","rYW5PXXTrTvbnJGI", "leonardb-db");

if(!$mysqli || $mysqli->connect_errno)
{
	echo "Connection error" . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

// sql query for dropdown filter
if (!($stmt = $mysqli->prepare("SELECT category FROM videoInventory")))
{
	echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

if (!$stmt->execute())
{
	echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}

$resultFilter = null;

$stmt->bind_result($resultFilter);





//dropdown filter

echo '<form method="GET" action="phpMySQL.php"> <select name="filter"><option selected> ALL </option>';
while($stmt->fetch())
{
	echo '<option>' . $resultFilter . '</option>';
}

echo '</select><input type="submit" value="FILTER"></form><br>';

$stmt->close();





//sql query for data table

if($setFilter == "ALL")
{

	if (!($stmt = $mysqli->prepare("SELECT name, category, length, rented FROM videoInventory")))
	{
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}

}
else
{

	if (!($stmt = $mysqli->prepare("SELECT name, category, length, rented FROM videoInventory WHERE category = ?")))
	{
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}


	if (!$stmt->bind_param("s", $setFilter))
	{
		echo "Binding parameters failed: (" . $stmt-errno . ") " . $stmt->error;
	}

}


if (!$stmt->execute())
{
	echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}

$resultName = null;
$resultCategory = null;
$resultLength = null;
$resultRented = null;

$stmt->bind_result($resultName, $resultCategory, $resultLength, $resultRented);





//generate table based on database call
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
//delete all button
echo '<br><br>';
echo ' <form action="upload.php" method="GET"><input type="hidden" name="deleteAll" value ="true"> <input type="submit" value="DELETE ALL"></form>';
?>





<?php
//close html tags
echo '</body>
</html>';

?>
