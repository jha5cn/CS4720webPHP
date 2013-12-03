<?php
	/*
	 * params: $group_id
	 * Given group id, returns activity_name, building_name, start time, end time and recurrence
	 */
	include_once 'dbloginkevin.php';

	$group = array();
	if ($stmt->prepare('SELECT activity_name, building_name, start_time, end_time, recurrence
						FROM Groups
						WHERE group_id=?')) {
		$stmt->bind_param('s', $group_id);
		$stmt->execute();
		$stmt->bind_result($activity_name, $building_name, $start_time, $end_time, $recurrence);
		if ($stmt->fetch()) {
			$group = array("activity_name" => $activity_name, "building_name" => $building_name, "start_time" => $start_time, "end_time" => $end_time, "recurrence" => $recurrence);
		}
		
	}

	echo json_encode($group);




?>