<?php
	// we are given $activity_name
	// given an activity name, find average location of registered users registered to that activity, 
	// then return closest building to that location
	include_once 'dblogin.php';
	// step 1: gather all users and their coordinates registered to activity passed
	$users = array();
	if ($stmt->prepare('SELECT user_name, user_x, user_y
						FROM registeredTo 
						NATURAL JOIN
						Users
						WHERE activity_name=?')) {
		$stmt->bind_param('s', $activity_name);
		$stmt->execute();
		$stmt->bind_result($user_name, $user_x, $user_y);
		while ($stmt->fetch()) {
			$users[] = array("user_name" => $user_name, 'x' => $user_x, 'y' => $user_y);
		}
	}
	$stmt->close();
	/*
	foreach ($users as $user_name => $coords) {
		echo "$user_name : " . $coords['x'] . " " . $coords['y'] . '<br>'; 
	}
	*/

	// step 2: gather all buildings and their coordinates where activity can take place
	$buildings = array();
	$stmt = $db_connection->stmt_init();
	if ($stmt->prepare('SELECT building_name, building_x, building_y
						FROM ActivityLocations 
						NATURAL JOIN
						Buildings
						WHERE activity_name=?')) {
		$stmt->bind_param('s', $activity_name);
		$stmt->execute();
		$stmt->bind_result($building_name, $building_x, $building_y);
		while ($stmt->fetch()) {
			$buildings[] = array("building_name" => $building_name, 'x' => $building_x, 'y' => $building_y);
		}
	}


	// STEP 3: get middle x and middle y
	$middleX = getMedian($users, 'x');
	$middleY = getMedian($users, 'y');
	$closest_building = getClosest($buildings, $middleX, $middleY);

	$outputTemp = array();
	$outputTemp[] = $closest_building['building_name'];
	echo json_encode($outputTemp);
	//echo json_encode(array("closest_building" => $closest_building));

	function getMedian($users, $axis) {
		if ($axis == 'x') {
			uasort($users, 'cmpX');
		} else {
			uasort($users, 'cmpY');
		}
		$index = (count($users) - 1) / 2;
		if (count($users) % 2 == 0 && count($users) > 1) {
			return ( $users[$index][$axis] + $users[$index + 1][$axis] ) / 2;
		} else if (count($users) % 2 == 1) {
			return $users[$index][$axis];
		} else {
			// count of array is 0
			// return center of uva which we approximated to old cabel hall
			if ($axis == 'x') {
				return 38.032939;
			} else {
				return -78.504814;
			}
		}
	}

	function getClosest($buildings, $middleX, $middleY) {
		$min = INF;
		$building = array("building_name" => "none", 'x' => 38.032939, "y" => -78.504814);
		foreach ($buildings as $i => $building) {
			$dist = getDistance($building['x'], $building['y'], $middleX, $middleY);
			if ($dist < $min) {
				$min = $dist;
				$building = $building['building_name'];
			}
		}
		return $building;
	}

	function getDistance($x1, $y1, $x2, $y2) {
		return sqrt(($x1 - $x2) * ($x1 - $x2) + ($y1 - $y2) * ($y1 - $y2));
	}



	function cmpX($a, $b) {
		if ($a['x'] == $b['x']) {
			return 0;
		} 
		return $a['x'] < $b['x'] ? -1 : 1;
	}
	function cmpY($a, $b) {
		if ($a['y'] == $b['y']) {
			return 0;
		} 
		return $a['y'] < $b['y'] ? -1 : 1;
	}
?>