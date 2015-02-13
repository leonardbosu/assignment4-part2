<?php

echo 'testing';


if ($_GET["name"] == null)
{
	echo 'Must enter video name';
}
else
{
	$newName = $_GET['name'];
	$newCategory = $_GET['category'];
	$newLength = $_GET['length'];

	echo $newName . $newCategory . $newLength;
}

$mysqli = new mysqli("oniddb.cws.oregonstate.edu","leonardb-db","rYW5PXXTrTvbnJGI", "leonardb-db");

if(!$mysqli || $mysqli->connect_errno)
{
	echo "Connection error" . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if (!($stmt = $mysqli->prepare("INSERT INTO videoInventory (name, category, length) VALUES (?,?,?)")))
{
	echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

if (!$stmt->bind_param("ssi", $newName, $newCategory, $newLength))
{
	echo "Binding parameters failed: (" . $stmt-errno . ") " . $stmt->error;
}

if (!$stmt->execute())
{
	echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}

$stmt->close();

?>