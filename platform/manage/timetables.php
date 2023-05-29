<?php
include_once('config/database.php');

// Get daily report
$pdo = Database::connect();
$sql = 'SELECT * FROM timetables WHERE state = 1';
$db_timetables  = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

Database::disconnect();

//fetch tha data from the database 
$timetables = array();
foreach ($db_timetables as $db_timetable) {
	$timetable = new stdClass();
	$timetable->pid = $db_timetable['id'];
	$timetable->name = $db_timetable['name'];
	$timetable->image = $db_timetable['image'];
	$timetable->date = date('j', strtotime($db_timetable['date']));
	$timetable->month = date('n', strtotime($db_timetable['date']));
	$timetable->year = date('Y', strtotime($db_timetable['date']));
	$timetable->day = 'monday';
	$timetable->start_time = $db_timetable['start_time'] ? date('H:i', strtotime($db_timetable['start_time'])) : '';
	$timetable->end_time = $db_timetable['end_time'] ? date('H:i', strtotime($db_timetable['end_time'])) : '';
	$timetable->color = $db_timetable['color'];
	$timetable->description = $db_timetable['webex'];
	
	array_push($timetables, $timetable);
}

echo json_encode($timetables);
?>