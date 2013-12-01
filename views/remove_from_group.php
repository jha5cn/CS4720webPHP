<?php
	include_once('dbloginkevin.php');

	/*
	 * param: $user_name, $user_password, $group_id
	 * Authenticates user and if successful, removes user from group
	 */
	$user_password = hash("md5", $user_password);


	if ($stmt->prepare("SELECT user_name, user_password FROM `Users` WHERE user_name=? and user_password=?") or die(mysqli_error1)) {
		$stmt->bind_param('ss', $user_name, $user_password);
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
	$stmt = $db_connection->stmt_init();
	if ($arr['success']) {
		$stmt = $db_connection->stmt_init();
		if ($stmt->prepare('DELETE 
							FROM URegisterG
							WHERE user_name=? AND group_id=?')) {
			$stmt->bind_param('ss', $user_name, $group_id);
			$stmt->execute();
		}
	}
	

	$db_connection->close();








?>