<?php 
require_once './libs/MysqliDb.php';
$db = new MysqliDb('10.9.18.4', 'business_school', '2KCkYMmm%;f!', 'platform');
$json = $db->rawQuery("SELECT id, name as title, start_time as start, end_time as end, date, saloon, who as speaker, expection, image, pdf, video FROM `timetables`");
echo json_encode($json, JSON_UNESCAPED_UNICODE);