<?php
require_once("inc.php");
//phone number ile sıfırlama

if ($_POST['email']) {
	

	if (strpos($_POST['email'], '@') !== false) { // email adresi
		$hata_mesaj = '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu! Lütfen tekrar deneyiniz.</div>';
	$tebrik_mesaj = '<div class="alert alert-success"><strong>Teşekkürler!</strong> Şifre sıfırlama talebiniz alınmıştır. Mail adresinize gönderilen doğrulama linkini kullanarak şifrenizi güncelleyebilirsiniz. </div><script>document.getElementById("password_form").style.display = "none";</script>';
		$email = valueClear($_POST['email']);
		$db->where('email', $email);
		$total = $db->getValue('web_user', "count(id)");
		if ($total < 1) {
			echo '<div class="alert alert-danger">Girmiş olduğunuz bilgiler ile sistemde kayıtlı kullanıcı bulunmamaktadır.  </div>';
			die();
		} else {
			// Onay Kodu Oluşturuyoruz.
			$onayKodu = getUuid();
			$data = array('reset_code' => $onayKodu);
			$db->where('email', $email);
			$id = $db->update('web_user', $data);

			if ($id) {
				$getdata = http_build_query(
					array('code' => $onayKodu)
				);

				$opts = array(
					'http' =>
					array(
						'method' => 'POST',
						'content' => $getdata
					)
				);

				$context = stream_context_create($opts);

				$body = file_get_contents('http://www.okul.pwc.com.tr/dosyalar/dahili/template/sifre_sifirlama.php?', false, $context);

				require_once("libs/class.phpmailer.php");
				require("libs/class.smtp.php");
				require("libs/class.pop3.php");

				// Mail Gönderme 
				$mail = new PHPMailer;

				$mail->IsSMTP();
			
				//Bireysel
				$mail->Host = "smtp.gmail.com";
				$mail->Username = 'rkapucuoglu@socialthinks.com';
				$mail->Password = 'Recep8990.';
				$mail->SMTPAuth = true;
				$mail->Port = 587;

				//Prod
				// $mail->Host = "10.9.18.5";
				// // used only when SMTP requires authentication  
				// //$mail->SMTPAuth = true;
				// $mail->Username = 'egitim@pwc.com.tr';
				// $mail->Password = '';
				// $mail->SMTPAuth = false;
				// $mail->SMTPAutoTLS = false;
				// $mail->Port = 25;

				$mail->CharSet = 'utf-8';
				$mail->setFrom('egitim@pwc.com.tr', 'Business School');

				$mail->AddAddress($email);
				// Name is optional
				$mail->addReplyTo('egitim@pwc.com.tr', 'Business School');
				$mail->setLanguage('tr', '/language');

				// Set email format to HTML
				$mail->Subject = 'Business School - Şifrenizi Sıfırlayın';
				$mail->msgHTML($body);
				if ($mail->send()) {
					$data = array('expression_time' => $db->now());
					$db->where('email', $email);
					$updateExp = $db->update('web_user', $data);
					echo $tebrik_mesaj;
				} else {
					echo $hata_mesaj . " - Mail Gönderilemedi.";

				}

			} else
				echo $hata_mesaj;

		}
	} else { //telefon
		$hata_mesaj = '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu! Lütfen tekrar deneyiniz.</div>';
		$tebrik_mesaj = '<div class="alert alert-success"><strong>Teşekkürler!</strong> Şifre sıfırlama talebiniz alınmıştır. Telefon numaranıza gönderilen doğrulama linkini kullanarak şifrenizi güncelleyebilirsiniz. </div><script>document.getElementById("password_form").style.display = "none";</script>';
		
		$telefon = valueClear($_POST['email']);
		$regex = '/^0\(\d{3}\)\s\d{3}-\d{4}$/';
		if (!preg_match($regex, $telefon)) { 
			$telefon = preg_replace('/^0(\d{3})(\d{3})(\d{2})(\d{2})$/', '0($1) $2-$3$4', $telefon);
		} 
		$db->where('phone', $telefon);
		$total = $db->getValue('web_user', "count(id)");
		if ($total < 1) {
			echo '<div class="alert alert-danger">Girmiş olduğunuz bilgiler ile sistemde kayıtlı kullanıcı bulunmamaktadır.  </div>';
			die();
		} else {
			// Onay Kodu Oluşturuyoruz.
			$onayKodu = getUuid();
			$data = array('reset_code' => $onayKodu);
			$db->where('phone', $telefon);
			$id = $db->update('web_user', $data);
			if ($id) {
				//sms gönder
				//telefonu uygun filtre
				$telefonNumber = preg_replace("/[^0-9]/", "", $telefon);
				$db->where('phone', $telefon);
				$result = $db->getOne('web_user');
				$name = $result['fullname'];
				$xml_data = "<MainmsgBody>
			<Command>0</Command>
			<PlatformID>1</PlatformID>
			<ChannelCode>581</ChannelCode>
			<UserName>pwcbss</UserName>
			<PassWord>Dty1HF4t</PassWord>
			<Mesgbody>Sayin $name, 'https://www.okul.pwc.com.tr/sifre-sifirlama.php?code=$onayKodu dogrulama linki ile şifre sıfırlama işlemlerini yapabilirsiniz.</Mesgbody>
			<Numbers>$telefonNumber</Numbers>
			<Type>1</Type>
			<Concat>1</Concat>
			<Originator>PWC TURKIYE</Originator>
			<SDate></SDate>
		   </MainmsgBody>";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'https://processor.smsorigin.com/xml/process.aspx');
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_TIMEOUT, 30);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_data);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				$response = curl_exec($ch);
				if (strpos($response, "ID") !== false) {
					$data = array('expression_time' => $db->now());
					$db->where('phone', $telefon);
					$updateExp = $db->update('web_user', $data);
					if ($updateExp)
						echo $tebrik_mesaj;
				} else {
					echo $hata_mesaj . " - Sms Gönderilemedi.";
				}
				// cURL'ü kapat
				curl_close($ch);
			} else
				echo $hata_mesaj;

		}
	}


} else {
	echo '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu. Lütfen tüm bilgileri eksiksiz doldurunuz.</div>';
}



