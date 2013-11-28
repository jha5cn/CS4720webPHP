<?php
	/*
	 * Given an activty name, returns an array of all locations registered to that activity
	 */
	include_once 'dblogin.php';

	$users = array();
	if ($stmt->prepare('SELECT building_name
						FROM ActivityLocations
						WHERE activity_name=?
						ORDER BY building_name ASC')) {
		$stmt->bind_param('s', $activity);
		$stmt->execute();
		$stmt->bind_result($building_name);
		while ($stmt->fetch()) {
			$users[] = $building_name;
		}
	}

	echo json_encode($users);




?>