<?php
	$SERVER = 'stardock.cs.virginia.edu';
	$USER = 'cs4720jha5cn';
	$PASS = 'webandmobile';
	$DB = 'cs4720jha5cn';


	$db_connection = new mysqli($SERVER, $USER, $PASS, $DB);

	if (mysqli_connect_error()) {
		echo "Can't connect!";
		return null;
	}

	$stmt = $db_connection->stmt_init();
?>