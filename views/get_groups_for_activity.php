<?php
	/*
	 * params: $activity_name
	 * Takes in an activity name and prints the list of groups associated with it in terms of time, list of participants, and location
	 */
	include_once 'dbloginkevin.php';

	$groups = array();
	if ($stmt->prepare('SELECT Groups.group_id, start_time, end_time, building_name, user_name, recurrence
						FROM Activities
						NATURAL JOIN Groups
						LEFT OUTER JOIN URegisterG
							ON Groups.group_id = URegisterG.group_id
						WHERE activity_name=?
						ORDER BY start_time ASC, group_id ASC, user_name ASC')) {
		$stmt->bind_param('s', $activity_name);
		$stmt->execute();
		$stmt->bind_result($group_id, $start_time, $end_time, $building_name, $user_name, $recurrence);
		while ($stmt->fetch()) {
			if (array_key_exists($group_id, $groups)) {
				array_push($groups[$group_id]['users'], $user_name);
			} else {
				$groups[$group_id] = array('start_time' => $start_time, 'end_time' => $end_time, 'building_name' => $building_name, 'recurrence' => $recurrence, 'users' => array());
				if ($user_name != null) {
					array_push($groups[$group_id]['users'], $user_name);
				}
			}
		}
		$ret_val = array();
		// convert to array
		foreach ($groups as $k => $val) {
			$ret_val[] = array('group_id' => $k, 'start_time' => $val['start_time'], 'end_time' => $val['end_time'], 'building_name' => $val['building_name'], 'recurrence' => $val['recurrence'], 'users' => $val['users']);
		}
	}

	echo json_encode($ret_val);




?>