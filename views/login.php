<?php
	include_once('dbloginkevin.php');

	$password = hash("md5", $password);


	if ($stmt->prepare("SELECT user_name, user_password FROM `Users` WHERE user_name=? and user_password=?") or die(mysqli_error1)) {
		$stmt->bind_param('ss', $username, $password);
		$stmt->execute();
		$stmt->bind_result($username, $password);
		if ($stmt->fetch()) {
			$arr = array('success' => true);
			echo json_encode($arr);
		} else {
			$arr = array('success' => false);
			echo json_encode($arr);
		}
	}

	$stmt->close();
	$db_connection->close();








?>