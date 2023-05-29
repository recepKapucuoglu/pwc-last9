<?php
include('dosyalar/dahili/elearning_connect.php');

if($_SESSION['dashboardUserElearningCode']){
$token_service = new ElearningService($_SESSION['dashboardUserElearningCode']);
    $token_service->loginElearningUser();
}
?>