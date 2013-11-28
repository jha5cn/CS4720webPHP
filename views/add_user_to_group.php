<?php
	/*
	 * params: $group_id, $user_name
	 * Takes in a username, group identifier, and adds that user to the group
	 */
	include_once 'dbloginkevin.php';

	$success = false;

	if ($stmt->prepare("INSERT INTO URegisterG (group_id, user_name) VALUES (?, ?)") or die(mysqli_error1)) {
		$stmt->bind_param('ss', $group_id, $user_name);
		if ($stmt->execute()) {
			$success = true;
		}
		$stmt->close();
	}
	
	$db_connection->close();
	$arr = array('success' => $success);
	echo json_encode($arr);




?>