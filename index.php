<?php
require 'flight/Flight.php';

Flight::route('/', function() {
	echo '<a href="http://plato.cs.virginia.edu/~cs4720f13beet/find_closest_building/CS4720">go here</a>';
});

Flight::route('/users/register/@user_name/@user_password/@user_x/@user_y', function($user_name, $user_password, $user_x, $user_y){
	Flight::render('register_full.php', array('user_name' => $user_name, 'user_password' => $user_password, 'user_x' => $user_x, 'user_y' => $user_y));
});

Flight::route('/users/removefromgroup/@user_name/@user_password/@group_id', function($user_name, $user_password, $group_id){
	Flight::render('remove_from_group.php', array('user_name' => $user_name, 'user_password' => $user_password, 'group_id' => $group_id));
});

Flight::route('/users/@user_name/groups', function($user_name){
	Flight::render('get_user_groups.php', array('user_name' => $user_name));
});

Flight::route('/find_closest_building/@activity_name', function($activity_name){
	Flight::render('find_closest_building.php', array('activity_name' => $activity_name));
});

Flight::route('/find_closest_building_copy/@activity_name', function($activity_name){
	Flight::render('find_closest_building_copy.php', array('activity_name' => $activity_name));
});

Flight::route('/find_closest_building_group/@group_id', function($group_id){
	Flight::render('find_closest_building_group.php', array('group_id' => $group_id));
});

Flight::route('/register/@username/@password', function($username, $password) {
	Flight::render('register.php', array('username' => $username, 'password' => $password));
});

Flight::route('/login/@username/@password', function($username, $password) {
	Flight::render('login.php', array('username' => $username, 'password' => $password));
});

Flight::route('/user_groups/@username', function($username) {
	Flight::render('user_groups.php', array('username' => $username));
});


Flight::route('/categories/@category_name', function($category_name) {
	Flight::render('categories.php', array('category_name' => $category_name));
});

Flight::route('/activities', function() {
	Flight::render('get_activities.php');
});

Flight::route('/activities/@activity/users', function($activity) {
	Flight::render('get_users_for_activity.php', array('activity' => $activity));
});

Flight::route('/activities/@activity/add/@start_time/@end_time/@building_name', function($activity_name, $start_time, $end_time, $building_name) {
	Flight::render('add_group_to_activity.php', array('activity_name' => $activity_name, 'start_time' => $start_time, 'end_time' => $end_time, 'building_name' => $building_name));
});

Flight::route('/activities/@activity/groups', function($activity_name) {
	Flight::render('get_groups_for_activity.php', array('activity_name' => $activity_name));
});

Flight::route('/groups/@group_id/add/@user_name', function($group_id, $user_name) {
	Flight::render('add_user_to_group.php', array('group_id' => $group_id, 'user_name' => $user_name));
});

Flight::route('/groups/@group_id/users', function($group_id) {
	Flight::render('get_users_for_group.php', array('group_id' => $group_id));
});

Flight::route('/activities/@activity/locations', function($activity) {
	Flight::render('get_locations_for_activity.php', array('activity' => $activity));
});

Flight::route('/activities/@activity_name/locations_new', function($activity_name) {
	Flight::render('get_locations_for_activity_new.php', array('activity_name' => $activity_name));
});

Flight::route('/@name/@id:[0-9]{3}', function($name, $id){
    echo "Welcome $name!  Your id is $id";
});

Flight::route('/@name/', function($name){
    echo "Welcome $name!";
});





Flight::start();
?>
