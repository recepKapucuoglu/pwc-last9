<?php
include('dosyalar/dahili/header.php');
session_start();
$logoutData=array("status"=>0);
$db->where('email',$_SESSION['dashboardUser']);
$logout=$db->update('web_user',$logoutData);
$_SESSION['dashboardUserStatus']=0;
if( $_SESSION['dashboardUser'] == "uyeol_step1"){ //kullanıcı üye olurken çıkış yapıyorsa kaydını silelim.

    $db->where('phone', $_SESSION['dashboardUserPhone']);
    $db->delete('web_user');
     
     if($ok){
        session_destroy();
        header("Location: https://www.okul.pwc.com.tr/uyelik");
        exit();
     }
}
if( $_SESSION['dashboardUser'] == "uyeol_step2"){ //üye bilgilerini giriş ekranındayken çıkış yaptıysa db ye üyelik durumunu kaydettik oradan başlatıcaz
        $db->where('phone', $_SESSION['dashboardUserPhone']);
        $db->delete('web_user');
        session_destroy();
        header("Location: https://www.okul.pwc.com.tr/uyelik");
        exit();
}
   
session_destroy();
header("Location: https://www.okul.pwc.com.tr/uyelik");
exit();
?>