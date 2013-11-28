<?php
	include_once('dbloginkevin.php');
	$user_password = hash("md5", $user_password);
	$success = false;

	if ($stmt->prepare("INSERT INTO Users (user_name, user_password, user_x, user_y) VALUES (?, ?, ?, ?)") or die(mysqli_error1)) {
		$stmt->bind_param('ssss', $user_name, $user_password, $user_x, $user_y);
		if ($stmt->execute()) {
			$success = true;
		}
		$stmt->close();
	}
	
	$db_connection->close();
	$arr = array('success' => $success);
	echo json_encode($arr);









?>