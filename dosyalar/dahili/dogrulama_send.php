<?php
require 'otp_function.php';

require_once("inc.php");

$hata_mesaj = '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu! Lütfen tekrar deneyiniz.</div>';
$tebrik_mesaj = '<div class="alert alert-success"><strong>Bilgilendirme!</strong> Doğrulama kodunuz E-posta adrsinize yeniden gönderilmiştir.</div>';

//mail dogrulama sistemi

if ($_SESSION['dashboardUser']) {
	$db->where('email', $_SESSION['dashboardUser']);
	$results = $db->get('web_user');
	foreach ($results as $value) {
		// $dashboardUserStatus=$value['status'];
		$dashboardUserMailStatus = $value['mail_status'];
		$adsoyad = $value['fullname'];
		$email = $value['email'];
	}
	// Onay Kodu Oluşturuyoruz. activation_code
	$onayKodu = crc16($email . bin2hex(openssl_random_pseudo_bytes(5)) . time());
	$data = array('activation_code_mail' => $onayKodu);
	$db->where('email', $email);
	$id = $db->update('web_user', $data);

	if ($id) {
		$getdata = http_build_query(
			array('adsoyad' => $adsoyad, 'code' => $onayKodu)
		);

		$opts = array(
			'http' =>
			array(
				'method' => 'POST',
				'content' => $getdata
			)
		);

		$context = stream_context_create($opts);
		$body = file_get_contents('http://www.okul.pwc.com.tr/dosyalar/dahili/template/uyelik_dogrulama.php?', false, $context);
		require_once("libs/class.phpmailer.php");
		require("libs/class.smtp.php");
		require("libs/class.pop3.php");

		// Mail Gönderme 
		$mail = new PHPMailer;

		$mail->IsSMTP();

		//Prod
		// $mail->Host = "10.9.18.5";
		//// used only when SMTP requires authentication  
		// $mail->Username = 'egitim@pwc.com.tr';
		// $mail->Password = '';
		// $mail->SMTPAuth = false;
		// $mail->SMTPAutoTLS = false; 
		// $mail->Port = 25; 

		//Bireysel
		$mail->Host = "smtp.gmail.com";
		$mail->Username = 'rkapucuoglu@socialthinks.com'; //SMTP username
		$mail->Password = 'Recep8990.'; //SMTP password
		$mail->SMTPAuth = true;
		$mail->Port = 587;

		$mail->CharSet = 'utf-8';
		$mail->setFrom('egitim@pwc.com.tr', 'Business School');

		$mail->AddAddress($email);
		// Name is optional
		$mail->addReplyTo('egitim@pwc.com.tr', 'Business School');
		$mail->setLanguage('tr', '/language');

		// Set email format to HTML
		$mail->Subject = 'Business School - Hesabınızı Doğrulayın';
		$mail->msgHTML($body);

		if ($mail->send()) {
			$_SESSION['dashboardUser'] = $email;
			$db->where('email', $_SESSION['dashboardUser']);
			$results = $db->get('web_user');
			foreach ($results as $value) {
				$_SESSION['dashboardUserName'] = $value['fullname'];
				$_SESSION['dashboardUserId'] = $value['id'];
				// $_SESSION['dashboardUserStatus'] = $value['status'];
				$_SESSION['dashboardUserMailStatus'] = $value['mail_status'];
			}
			$dataLogon = array('last_login_date' => $db->now(), 'expression_time' => $db->now());
			$db->where('email', $_SESSION['dashboardUser']);
			$idLogon = $db->update('web_user', $dataLogon);
			$random = crc16(time());
			$dogrula = "https://www.okul.pwc.com.tr/mail_uyelik_dogrulama.php?otp=$random";
			if ($idLogon)
				echo "<script language='JavaScript'>location.href='$dogrula'</script>";
			else
				echo $hata_mesaj;

			echo $tebrik_mesaj;
		} else {
			echo $hata_mesaj . " - Mail Gönderilemedi." . $mail->ErrorInfo;

		}

	} else
		echo $hata_mesaj;


} else {
	echo '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu. Lütfen tüm bilgileri eksiksiz doldurunuz.</div>';
}

?>