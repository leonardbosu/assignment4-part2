<?php

//echo 'testing';


if ($_GET["name"] == null && $_GET["delName"] == null && $_GET["rentName"] == null)
{
	echo 'Error: Must enter video name! <br><br>';
	echo 'Click <a href="phpMySQL.php"> HERE </a> to return.';
}
else if ($_GET["name"] != null)
{
	if ( $_GET["length"] == null)
	{
		$newName = $_GET['name'];
		$newCategory = $_GET['category'];
		$newLength = $_GET['length'];

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

		header('Location: http://web.engr.oregonstate.edu/~leonardb/PastAssignments/Assignment4-part2/phpMySQL.php');
	}
	else if (!is_numeric($_GET["length"]) || $_GET["length"] < 0)
	{
		echo 'Error: Length must be a positive number! <br><br>';
		echo 'Click <a href="phpMySQL.php"> HERE </a> to return.';
	}
	else
	{
		$newName = $_GET['name'];
		$newCategory = $_GET['category'];
		$newLength = $_GET['length'];

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

		header('Location: http://web.engr.oregonstate.edu/~leonardb/PastAssignments/Assignment4-part2/phpMySQL.php');
	}
}


if ($_GET["delName"] != null)
{
	$delName = $_GET["delName"];

	$mysqli = new mysqli("oniddb.cws.oregonstate.edu","leonardb-db","rYW5PXXTrTvbnJGI", "leonardb-db");

	if(!$mysqli || $mysqli->connect_errno)
	{
		echo "Connection error" . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

	if (!($stmt = $mysqli->prepare("DELETE FROM videoInventory WHERE name = ?")))
	{
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}

	if (!$stmt->bind_param("s", $delName))
	{
		echo "Binding parameters failed: (" . $stmt-errno . ") " . $stmt->error;
	}

	if (!$stmt->execute())
	{
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}

	$stmt->close();

	header('Location: http://web.engr.oregonstate.edu/~leonardb/PastAssignments/Assignment4-part2/phpMySQL.php');
}

if ($_GET["rentName"] != null)
{
	$rentName = $_GET["rentName"];

	$mysqli = new mysqli("oniddb.cws.oregonstate.edu","leonardb-db","rYW5PXXTrTvbnJGI", "leonardb-db");

	if(!$mysqli || $mysqli->connect_errno)
	{
		echo "Connection error" . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

	if (!($stmt = $mysqli->prepare("UPDATE videoInventory SET rented = ((rented-1)*(-1)) WHERE name = ?")))
	{
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}

	if (!$stmt->bind_param("s", $rentName))
	{
		echo "Binding parameters failed: (" . $stmt-errno . ") " . $stmt->error;
	}

	if (!$stmt->execute())
	{
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}

	$stmt->close();

	header('Location: http://web.engr.oregonstate.edu/~leonardb/PastAssignments/Assignment4-part2/phpMySQL.php');
}



?>