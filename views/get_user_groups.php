<?php
	/*
	 * params: $user_name
	 * Takes in a username and prints out each group that user is a part of activity name/current number of participants/group time/group location
	 */
	include_once 'dbloginkevin.php';

	$groups = array();
	if ($stmt->prepare('SELECT g.group_id, t1.admin, g.activity_name, g.building_name, g.start_time, g.end_time, g.recurrence, COUNT(*) as num_registered
						FROM (SELECT * 
						      FROM URegisterG
						      WHERE user_name=?) as t1
						NATURAL JOIN Groups as g
						JOIN URegisterG as ug
							ON g.group_id = ug.group_id
						GROUP BY ug.group_id
						ORDER BY ug.group_id ASC')) {
		$stmt->bind_param('s', $user_name);
		$stmt->execute();
		$stmt->bind_result($group_id, $admin, $activity_name, $building_name, $start_time, $end_time, $recurrence, $num_registered);
		while ($stmt->fetch()) {
			$groups[] = array('group_id' => $group_id, 'activity_name' => $activity_name, 'building_name' => $building_name, 'start_time' => $start_time, 'end_time' => $end_time, 'recurrence' => $recurrence, 'num_registered' => $num_registered, 'admin' => $admin);
		}
	}

	echo json_encode($groups);




?>