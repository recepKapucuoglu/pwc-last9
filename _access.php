<?php 
ob_start();
$page_url = $_SERVER['REQUEST_URI'];
$page_url = explode("/",$page_url);

require_once("dosyalar/dahili/inc.php");
include($url_rewrite);
exit;
?>