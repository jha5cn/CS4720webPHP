<?php
require 'flight/Flight.php';

Flight::route('/', function() {
	echo '<a href="http://plato.cs.virginia.edu/~cs4720f13beet/find_closest_building/CS4720">go here</a>';
});

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