<?php session_start();

if (!$_SESSION['useradmin'])
{
require_once("libs/MysqliDb.php");
require_once("libs/dbObject.php");

// db instance
// $db = new Mysqlidb('10.9.18.4', 'business_school', '2KCkYMmm%;f!', 'school');
$db = new Mysqlidb('localhost','root','','school');
// enable class autoloading
dbObject::autoload("models");	
	

	
include('_function.php');
	$ipler = array('213.74.59.98','213.74.20.182','85.96.88.60','82.222.18.170','91.93.169.116','88.235.30.53','176.40.255.250','127.0.0.1');
	$kimlik = GetIP();
	$giris_ip = 0;
	foreach($ipler as $ban){
		if($ban == $kimlik){
			$giris_ip = 1;
		}
	}
	if($giris_ip <> 1){
		header('Location: https://www.okul.pwc.com.tr/');exit();
	}
$db->where('email', $_COOKIE['useradmin']);
$results = $db->get('netia_admin');
foreach ($results as $value) {
	$usr_surname =  $value['surname'];
	$usr_name =  $value['name'];
	$usr_email =  $value['email'];
	$usr_title =  $value['title'];
	$usr_id =  intval($value['id']);
}

	
$db->where('id', 1);
$results = $db->get('settings');
foreach ($results as $value) {
	$customer_name =  $value['cust_name'];
}


	
} else {
?>	
<script>
	location.href="	index.php";
</script>    
<?php } ?>

