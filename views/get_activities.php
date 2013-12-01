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
			if (array_key_exists($category, $categories)) {
				array_push($categories[$category], $activity_name);
			} else {
				$categories[$category] = array($activity_name);
			}
			
		}
		
	}

	echo json_encode($categories);




?>