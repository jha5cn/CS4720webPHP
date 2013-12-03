<?php
	include_once('dbloginkevin.php');
	$password = hash("md5", $password);
	$success = false;

	if ($stmt->prepare("INSERT INTO Users (user_name, user_password) VALUES (?, ?)") or die(mysqli_error1)) {
		$stmt->bind_param('ss', $username, $password);
		if ($stmt->execute()) {
			$success = true;
		}
		$stmt->close();
	}
	
	$db_connection->close();
	$arr = array('success' => $success);
	echo json_encode($arr);









?>