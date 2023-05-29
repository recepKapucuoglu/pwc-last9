<?php	
error_reporting(1); 
require_once("libs/MysqliDb.php");
require_once("libs/dbObject.php");

// db instance
$db = new Mysqlidb('78.46.194.208', 'socialth_usr', '2KCkYMmm%;f!', 'socialth_pwc');
// enable class autoloading
dbObject::autoload("models");	

require_once('_function.php');
?>

