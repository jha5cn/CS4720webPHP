<?php
	$SERVER = 'stardock.cs.virginia.edu';
	$USER = 'cs4720kmw8sf';
	$PASS = 'kevin789';
	$DB = 'cs4720kmw8sf';


	$db_connection = new mysqli($SERVER, $USER, $PASS, $DB);

	if (mysqli_connect_error()) {
		echo "Can't connect!";
		return null;
	}

	$stmt = $db_connection->stmt_init();
?>