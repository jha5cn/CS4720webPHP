<?php
	/*
	 * Given an activty name, returns an array of all users registered to that activity
	 */
	include_once 'dbloginkevin.php';

	$users = array();
	if ($stmt->prepare('SELECT user_name
						FROM registeredTo
						WHERE activity_name=?')) {
		$stmt->bind_param('s', $activity);
		$stmt->execute();
		$stmt->bind_result($username);
		while ($stmt->fetch()) {
			$users[] = $username;
		}
	}

	echo json_encode($users);




?>