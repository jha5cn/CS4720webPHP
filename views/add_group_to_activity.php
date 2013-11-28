<?php
	/*
	 * params: $activity_name, $start_time, $end_time, $building_name
	 * Takes in activityname, time, location username, and creates a new group associated with that activity
	 */
	include_once 'dbloginkevin.php';

	$success = false;

	if ($stmt->prepare("INSERT INTO Groups (activity_name, start_time, end_time, building_name) VALUES (?, ?, ?, ?)") or die(mysqli_error1)) {
		$stmt->bind_param('ssss', $activity_name, $start_time, $end_time, $building_name);
		if ($stmt->execute()) {
			$success = true;
		}
		$stmt->close();
	}
	
	$db_connection->close();
	$arr = array('success' => $success);
	echo json_encode($arr);




?>