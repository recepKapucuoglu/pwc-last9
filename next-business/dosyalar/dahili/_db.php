<?php	
error_reporting(1); 
require_once("libs/MysqliDb.php");
require_once("libs/dbObject.php");

// db instance
$db = new Mysqlidb('10.9.18.4', 'socialth_usr', '2KCkYMmm%;f!', 'st_platform');
// enable class autoloading
dbObject::autoload("models");	

require_once('_function.php');

?>

