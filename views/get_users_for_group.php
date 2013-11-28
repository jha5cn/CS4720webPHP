<?php
	/*
	 * params: $group_id
	 * Given a group_id, returns an array of all users registered to that group
	 */
	include_once 'dbloginkevin.php';

	$users = array();
	if ($stmt->prepare('SELECT user_name
						FROM Groups
						NATURAL JOIN URegisterG
						WHERE group_id=?')) {
		$stmt->bind_param('s', $group_id);
		$stmt->execute();
		$stmt->bind_result($username);
		while ($stmt->fetch()) {
			$users[] = $username;
		}
	}

	echo json_encode($users);




?>