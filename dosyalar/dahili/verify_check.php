<?php
if(!isset($db)){
	include __DIR__ . "/_db.php";
}
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$path = parse_url($actual_link, PHP_URL_PATH);
$validUrls = ["/mail_uyelik_dogrulama_step3.php","/dosyalar/dahili/verify_user_otp_mail.php","/dosyalar/dahili/verify_user_otp_resend_mail.php","/uyelik-dogrulama.php","/dosyalar/dahili/sign_send_step2.php", "/dosyalar/dahili/verify_user_otp.php", "/dosyalar/dahili/verify_user_otp_resend.php","/dosyalar/dahili/login_phone_update_screen.php","/aydinlatma-metni","/yasal-uyari","/uyelik-sozlesmesi" ,"/acik-riza-metni"];
if(isset($_SESSION["dashboardUserPhone"]) || isset($_SESSION["dashboardUser"]) ){
  $db->where('email', $_SESSION['dashboardUser']);
	$results = $db->get('web_user');
	foreach ($results as $value) {
		$status=$value['status'];
	}
	if($status==0){
		$_SESSION['dashboardUserStatus']=0;
	}
	$dashboardUserStatus=$_SESSION['dashboardUserStatus'];
  if($dashboardUserStatus<>1 && !in_array($path, $validUrls)){ //kullanıcının telefon numarası onaylo degilse bu adreste kalmasını bekle
    header("Location: https://www.okul.pwc.com.tr/uyelik-dogrulama.php");
  }
   if($_SESSION['dashboardStep3MailEkranı']<>0 && !in_array($path, $validUrls)){ //kullanıcı mail dogrulama ekranındaysa farklı bir sayfaya gitmesini engelle 
    header("Location: https://www.okul.pwc.com.tr/mail_uyelik_dogrulama_step3.php");
  }
}


