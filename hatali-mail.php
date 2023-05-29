<?php
include "dosyalar/dahili/_db.php";
session_start();
// Session yoksa doğrulamasına izin verme
if ($_SESSION['dashboardUser']) {
    // kullanıcının zaten aktif olup olmadığını öğrenelim.
    $isActive = $_SESSION['dashboardUserStatus'];
	    // zaten aktifse burada ne işi var?
    if ($isActive) {
        header("Location: https://www.okul.pwc.com.tr/dashboard-hesabim.php");
        exit();
    } else {
       if( $_SESSION['dashboardUser'] == "uyeol_step1"){
			$db->where('phone', $_SESSION['dashboardUserPhone']);
			 $ok = $db->delete('web_user');
			 if($ok){
				session_destroy();
				header("Location: https://www.okul.pwc.com.tr/uyelik");
				exit();
			 }
            }
				session_destroy();
				header("Location: https://www.okul.pwc.com.tr/uyelik");
				exit();
	}
} else {
	  header("Location: https://www.okul.pwc.com.tr/");
    exit();
}