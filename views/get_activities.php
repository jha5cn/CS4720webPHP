<?php
	/*
	 * params: none
	 * Gets all activities and categories
	 */
	include_once 'dbloginkevin.php';

	$categories = array();
	if ($stmt->prepare('SELECT activity_name, category
						FROM Activities
						ORDER BY category, activity_name')) {
		$stmt->execute();
		$stmt->bind_result($activity_name, $category);
		while ($stmt->fetch()) {
			// find index
			$index = -1;
			for ($i = 0; $i < count($categories); ++$i) {
				if ($categories[$i]['category'] == $category) {
					$index = $i;
				}
			}
			if ($index != -1) {
				array_push($categories[$index]['activities'], $activity_name);
			} else {
				$categories[] = array("category" => $category, "activities" => array($activity_name));
			}
			
		}
		
	}

	echo json_encode($categories);




?>