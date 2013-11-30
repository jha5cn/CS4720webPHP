<?php
	/*
	 * param: $activity_name
	 * Given an activty name, returns an array of all locations registered to that activity
	 */
	include_once 'dbloginkevin.php';

	$locations = array();
	if ($stmt->prepare('SELECT building_name, building_x, building_y
						FROM ActivityLocations
						NATURAL JOIN Buildings
						WHERE activity_name=?
						ORDER BY building_name ASC')) {
		$stmt->bind_param('s', $activity_name);
		$stmt->execute();
		$stmt->bind_result($building_name, $x, $y);
		while ($stmt->fetch()) {
			$locations[] = array("building_name" => $building_name, "x" => $x, "y" => $y);
		}
	}

	echo json_encode($locations);




?>