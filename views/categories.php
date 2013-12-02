<?php
	/*
	 * Given a category name, gets all activities in that category alphabetically
	*/
	include_once 'dbloginkevin.php';
	$results = array();
	if ($stmt->prepare('SELECT activity_name, activity_image_url
						FROM Activities
						WHERE category=?
						ORDER BY activity_name ASC')) {
		$stmt->bind_param('s', $category_name);
		$stmt->execute();
		$stmt->bind_result($activity_name, $activity_image_url);
		while ($stmt->fetch()) {
			$results[] = array("activity_name" => $activity_name, "activity_image_url" => $activity_image_url);
		}


	}
	echo json_encode($results);



?>