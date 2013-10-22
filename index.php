<?php
require 'flight/Flight.php';

Flight::route('/find_closest_building/@activity_name', function($activity_name){
	Flight::render('find_closest_building.php', array('activity_name' => $activity_name));
});



Flight::route('/@name/@id:[0-9]{3}', function($name, $id){
    echo "Welcome $name!  Your id is $id";
});

Flight::route('/@name/', function($name){
    echo "Welcome $name!";
});



Flight::start();
?>
