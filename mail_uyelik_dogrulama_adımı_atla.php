<?php
include "dosyalar/dahili/_db.php";
session_start();
// Session yoksa doğrulamasına izin verme
if ($_SESSION['dashboardUser']) {

  if($_SESSION['dashboardStep3MailEkranı']<>0){
    $_SESSION['dashboardStep3MailEkranı']=0;
  }

        header("Location: https://www.okul.pwc.com.tr/dashboard.php");
        exit();
} else {
	  header("Location: https://www.okul.pwc.com.tr/");
    exit();
}