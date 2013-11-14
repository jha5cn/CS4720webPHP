<?php
	/*
	 * Given a category name, gets all activities in that category alphabetically
	*/
	include_once 'dblogin.php';
	$results = array();
	if ($stmt->prepare('SELECT activity_name
						FROM Activities
						WHERE category=?
						ORDER BY activity_name ASC')) {
		$stmt->bind_param('s', $category_name);
		$stmt->execute();
		$stmt->bind_result($activity_name);
		while ($stmt->fetch()) {
			$results[] = $activity_name;
		}


	}
	echo json_encode($results);



?>