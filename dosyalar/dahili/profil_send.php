<?php
require_once("inc.php");
require "otp_function.php";
require __DIR__ . '/libs/class.phpmailer.php';
require __DIR__ . '/libs/class.smtp.php';
require __DIR__ . '/libs/class.pop3.php';
function sendMail($adsoyad, $onaykodu, $email)
{
	$getdata = http_build_query(
		array('adsoyad' => $adsoyad, 'code' => $onaykodu)
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


	// Mail Gönderme
	$mail = new PHPMailer;

	$mail->IsSMTP();

	//Prod
	// // used only when SMTP requires authentication
	// //$mail->SMTPAuth = true;
	// $mail->Host = "10.9.18.5";
	// $mail->Username = 'egitim@pwc.com.tr';
	// $mail->Password = '';
	// $mail->SMTPAuth = false;
	// $mail->SMTPAutoTLS = false;
	// $mail->Port = 25;

	//Bireysel
	$mail->Host = "smtp.gmail.com";
	$mail->Username = 'rkapucuoglu@socialthinks.com';
	$mail->Password = 'Recep8990.';
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
	$mailSent = $mail->send();
	if (!$mailSent) {
		return false;
	}
	return true;
}
$hata_mesaj = '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu! Lütfen tekrar deneyiniz.</div>';
$tebrik_mesaj = '<div class="alert alert-success"><strong>Bilgilendirme!</strong> Bilgileriniz başarıyla güncellenmiştir.';
// $tebrik_mesaj .= '<script>setTimeout(function(){
// 	window.location.href = "https://www.okul.pwc.com.tr/dashboard-hesabim.php";
//    }, 1000);</script>';
if ($_POST['id']) {
	$user_id = valueClear($_POST['id']);
	$adsoyad = valueClear($_POST['adsoyad']);
	$email = valueClear($_POST['email']);
	$telefon = valueClear($_POST['telefon']);
	$sifre = valueClear($_POST['sifre']);
	$sifre2 = valueClear($_POST['sifre2']);
	$firma = valueClear($_POST['firma']);
	$unvan = valueClear($_POST['unvan']);
	$adres = valueClear($_POST['adres']);
	$mevcut_sifre = valueClear($_POST['mevcutsifre']);
	$notification = valueClear($_POST['notification']);
	$mail_changed = (strval($_SESSION['dashboardUser']) == strval($email)) ? 1 : 0; //email değişmiş mi? 1- degişmemiş 0-değişmiş
	$telefon_changed = (strval($_SESSION['dashboardUserPhone']) == strval($telefon)) ? 1 : 0; //telefon değişmiş mi? 1- degişmemiş 0-değişmiş

	$db->where('id', $user_id);
	$sonuc = $db->getOne('web_user');
	$mail_aktifMi = $sonuc['mail_status'];

	// mail aktif değilse işlem yaptırma
	if ($mail_aktifMi <> 1) {
		echo '<div class="alert alert-danger"><strong>Uyarı!</strong> Bilgilerinizi güncelleyebilmek için lütfen mail adresinizi doğrulayınız.</div>';
		die();
	}
	// mail değişmişse,
	if ($mail_changed == 0) {
		$db->where("email", $email);
		$nofusers = $db->get("web_user");
		if ($db->count > 0) {
			echo '<div class="alert alert-danger"><strong>Uyarı!</strong> Bu email adresi başka kullanıcı tarafından kullanılmaktadır.</div>';
			die();
		}
	}
	// telefon değişmişse,
	if ($telefon_changed == 0) {
		$db->where("phone", $telefon);
		$nofusers = $db->get("web_user");
		if ($db->count > 0) {
			echo '<div class="alert alert-danger"><strong>Uyarı!</strong> Bu telefon numarası başka kullanıcı tarafından kullanılmaktadır.</div>';
			die();
		}
	}

	

	// Şifre değişikliği var
	if ($mevcut_sifre <> "") {
		$db->where('email', $_SESSION['dashboardUser']);
		$result = $db->getOne('web_user');
		//girilen  mevcut şifre dogrumu
		if (!webUserPasswordVerify($mevcut_sifre, $result['password'])) {
			echo "<br/><div class=\"alert alert-danger\">
									<strong> Uyarı! </strong> Girdiğiniz mevcut şifreniz hatalı!
								  </div>";
			die();
		}


		$db->where('email', $_SESSION['dashboardUser']);
		$total = $db->getValue('web_user', "count(id)");
		if ($total > 0) {
			if ($sifre <> $sifre2) {
				echo '<div class="alert alert-danger">Girmiş olduğunuz şifreler birbirleriyle eşleşmiyor. </div>';
				die();
			} else {
				if (preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $sifre)) {
					// Check if this password used before 
					if (webUserUsedThisPasswordBefore($_SESSION['dashboardUser'], $sifre)) {
						echo '<div class="alert alert-danger">Şifreniz son 10 şifrenizden farklı olmalıdır. </div>';
						die();
					}

					$data = [
						'password' => webPasswordHash($sifre),
					];
					$db->where('id', $user_id);
					$update_mail = $db->update('web_user', $data);
					echo '<div class="alert alert-success"> <strong>Bilgilendirme!</strong> Şifreniz güncellenmiştir. </div>';
		
					//	sifre dogru güncellenmişse
					if ($mail_changed == 0) {

						$data = [
							"mail_status" => 0,
							"email" => $email,
							"fullname" => $adsoyad,
							'company' => $firma,
							'title' => $unvan,
							'address' => $adres,
							// 'password' => webPasswordHash($sifre),
						];
						$db->where('id', $user_id);
						$update_mail = $db->update('web_user', $data);
						if ($update_mail) {
							$_SESSION['dashboardUser'] = $email;
							
							echo '<div class="alert alert-success"> <strong>Bilgilendirme!</strong> E-mail adresiniz güncellenmiştir. </div>';

						}

					}
					if ($telefon_changed == 0) {
						echo '<div class="alert alert-success"> <strong>Bilgilendirme!</strong> Telefon numaranız güncellenmiştir yeni telefon numaranıza gelecek olan şifreyi lütfen ekrana giriniz </div>';

					}
					if ($telefon_changed == 0) {
						$data = [
							"status" => 0,
							"phone" => $telefon,
							"fullname" => $adsoyad,
							'company' => $firma,
							'title' => $unvan,
							'address' => $adres,
							// 'password' => webPasswordHash($sifre),
						];
						$db->where('id', $user_id);
						$db->update('web_user', $data);
						if ($update_phone) {
							$_SESSION['dashboardUserPhone'] = $telefon;
							echo '<div class="alert alert-success"> <strong>Bilgilendirme!</strong>Telefon numaranız güncellenmiştir yeni telefon numaranıza gelecek olan şifreyi lütfen ekrana giriniz  </div>';
						}
					}
				} else {
					echo '<div class="alert alert-danger">• Şifreniz en az 10 karakter uzunluğunda olmalı, <br/>• Büyük/küçük harf, rakam veya özel karakter içermelidir.</div>';
				}
			}

		} else {
			echo '<div class="alert alert-danger">Girmiş olduğunuz eski şifre yanlış. Lütfen tekrar deneyiniz. </div>';
			die();
		}
	}

	//sifre degisikliği yok
	if ($mevcut_sifre == "") {

		if ($mail_changed == 0) {

			$data = [
				"mail_status" => 0,
				"email" => $email,
				"fullname" => $adsoyad,
				'company' => $firma,
				'title' => $unvan,
				'address' => $adres,
			];
			$db->where('id', $user_id);
			$update_mail = $db->update('web_user', $data);
			if ($update_mail) {
				$_SESSION['dashboardUser'] = $email;
				echo '<div class="alert alert-success"> <strong>Bilgilendirme!</strong> E-mail adresiniz güncellenmiştir.</div>';

			}

		}
		if ($telefon_changed == 0) {
			echo '<div class="alert alert-success"><strong>Bilgilendirme!</strong> Telefon numaranız güncellenmiştir.</div>';
			
		}
		if ($telefon_changed == 0) {
			$data = [
				"status" => 0,
				"phone" => $telefon,
				"fullname" => $adsoyad,
				'company' => $firma,
				'title' => $unvan,
				'address' => $adres,
			];
			$db->where('id', $user_id);
			$db->update('web_user', $data);
			if ($update_phone) {
				$_SESSION['dashboardUserPhone'] = $telefon;		
				echo '<div class="alert alert-success"> <strong>Bilgilendirme!</strong>Telefon numaranız güncellenmiştir.</div>';
			}
		}
		

	}


	//mail , telefon ve sifrede değişiklik yok iken diğer bilgiler değişiyorsa
	if (($mail_changed == 1 && $telefon_changed == 1 && $mevcut_sifre == "")  ) {

		$data = [
			"fullname" => $adsoyad,
			'company' => $firma,
			'title' => $unvan,
			'address' => $adres
		];
		$db->where('id', $user_id);
		$update_mail = $db->update('web_user', $data);
		if ($update_mail) {
			$_SESSION['dashboardUser'] = $email;
			echo $tebrik_mesaj;
		}
	}

	//bekleme süreleri
	if (($mail_changed == 0 && $telefon_changed == 0 && $mevcut_sifre != "")  ) { //3ü birden degişiyor ise
		echo '<script>setTimeout(function(){
			window.location.href = "https://www.okul.pwc.com.tr/dashboard-hesabim.php";
		   }, 4000);</script>';
	}
	else {
		echo '<script>setTimeout(function(){
			window.location.href = "https://www.okul.pwc.com.tr/dashboard-hesabim.php";
		   }, 1500);</script>';
	}




} else {
	echo '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu. Lütfen tüm bilgileri eksiksiz doldurunuz.</div>';
}