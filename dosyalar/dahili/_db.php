<?php	
@session_start(['cookie_secure' => true,'cookie_httponly' => true]);
//ini_set('session.gc_maxlifetime', "86400"); 
ob_start();
 error_reporting(0); 
//error_reporting(E_ALL); 
require_once("libs/MysqliDb.php");
require_once("libs/dbObject.php");

// db instance
$db = new Mysqlidb('localhost', 'root', '', 'school');

//$db = new Mysqlidb('10.9.18.6', 'business_school', '2KCkYMmm%;f!', 'school');
// enable class autoloading
dbObject::autoload("models");	

require_once('_function.php');

// Eğitimleri çekiyoruz.
require_once('functions.php');
$egitimler = egitimler_db();
//Site Genel Ayarlar

$db->where('id', 1);
$results = $db->get('settings');
foreach ($results as $value) {
	$site_title =  $value['title'];
	$site_keywords =  $value['keywords'];
	$site_description =  $value['description'];
	$site_slogan =  $value['slogan'];
	$site_url =  $value['site_url'];
	$site_facebook =  $value['facebook'];
	$site_twitter =  $value['twitter'];
	$site_instagram =  $value['instagram'];
	$site_youtube =  $value['youtube'];
	$site_linkedin =  $value['linkedin'];
}
$dateToday = date("Y-m-d");
?>

