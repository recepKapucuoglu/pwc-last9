<?php
	require_once("inc.php");

	$hata_mesaj =  '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu! Lütfen tekrar deneyiniz.</div>'; 
	$tebrik_mesaj =  '<div class="alert alert-success"><strong>Bilgilendirme!</strong> Doğrulama kodunuz E-posta adrsinize yeniden gönderilmiştir.</div>'; 
	$actual = valueClear($_POST["pass"]);
	$expected = $_SESSION["sms_token"];
	$redirect_url = valueClear(base64_decode($_POST["redirect"]));
	if (valueClear($_POST['pass'])){
		
					if($actual == $expected) {
						$_SESSION['withoutEmail']=$_SESSION["sms_mail"];
						echo "<script language='JavaScript'>location.href='$redirect_url';</script>";
					} else {
						echo '<div class="alert alert-danger"><strong>Uyarı!</strong> Şifrenizi yanlış girdiniz, lütfen tekrar deneyiniz.</div>'; 
					}
				
	} else {
		echo '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu. Lütfen tüm bilgileri eksiksiz doldurunuz.</div>'; 
	}
?>
