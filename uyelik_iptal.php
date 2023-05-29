<?php
include "dosyalar/dahili/_db.php";
session_start();
// Session yoksa doğrulamasına izin verme
if ($_SESSION['dashboardUser']) {
    // veritabanından aktif olup olmadığını öğreniyoruz
    $db->where('email', $_SESSION['dashboardUser']);
    $results = $db->getOne('web_user');
    // kullanıcının zaten aktif olup olmadığını öğrenelim.
    $isActive = $_SESSION['dashboardUserStatus'];
	    // zaten aktifse burada ne işi var?
        
    if ($isActive) {
        header("Location: https://www.okul.pwc.com.tr/dashboard-hesabim.php");
        exit();
    } else {
			$db->where('email', $_SESSION['dashboardUser']);
			$ok = $db->delete('web_user');
			if($ok){
				session_destroy();
				header("Location: https://www.okul.pwc.com.tr/uyelik");
				exit();
			 }
	}
} else {
	  header("Location: https://www.okul.pwc.com.tr/");
    exit();
}