<?php
	require_once("inc.php");
	
	require_once("libs/class.phpmailer.php");
	require("libs/class.smtp.php");
	require("libs/class.pop3.php"); 
	$hata_mesaj =  '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.</div>'; 
	$tebrik_mesaj =  '<div class="alert alert-success"><strong>Teşekkürler!</strong> Formunuz bize ulaşmıştır. Business School ekibimiz en kısa sürede sizinle iletişime geçecektir. Hizmetlerimize gösterdiğiniz ilgi için teşekkür ederiz. </div>'; 
	
	if($_POST['adsoyad']) {
		$adsoyad = valueClear($_POST['adsoyad']);
		$email = valueClear($_POST['email']);
		$mesaj = valueClear($_POST['mesaj']);
		
		
		//Daha önce form kaydedilmiş mi? Kontrol ediyoruz.
		$db->where('adsoyad', $adsoyad);
		$db->where('email', $email);
		$db->where('mesaj', $mesaj);
		$formCount = $db->getValue ('contact_form', "count(id)");
		// Eğer daha önce aynı bilgiler ile kayıt oluşturulmuşsa tebrik mesajı verilir
		if($formCount > 0) {
			echo $tebrik_mesaj;
		} else { 
		
			// eğer kayıt yoksa kayıt yapılarak entegrasyon yapılır.
			$data = Array (
				'id' 				=> NULL,
				'adsoyad' 			=> $adsoyad,
				'email' 			=> $email,			
				'mesaj' 			=> $mesaj,
				'kayit_tarihi' 		=> $db->now()
			);
			$formKayit = $db->insert ('contact_form', $data);
			// Kayıt başarılıysa
			if ($formKayit) {
				
				$body="<html>
					<head>
				  <title>Business School - İletişim Formu</title>
				  <body>\n";
				$body.="<table rules='all' style='border-color: #666; font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#333;' cellpadding='10'>
				<thead><tr><td colspan='2'><b>KAYIT BİLGİLERİ</b></td></tr></thead>";
				$body.="<tr><td width='150'><b>Ad Soyad :</b></td><td>".$adsoyad."</td></tr>";
				$body.="<tr><td width='150'><b>Email :</b></td><td>".$email."</td></tr>";
				$body.="<tr><td width='150'><b>Mesaj :</b></td><td>".$mesaj."</td></tr>";
				$body.="</table><br/>";
				$body.="</body></head></html>";
				
				// Mail Gönderme 
				$mail = new PHPMailer;
    
				$mail->IsSMTP();
				$mail->Host = "10.9.18.5";

				// used only when SMTP requires authentication  
				//$mail->SMTPAuth = true;
				$mail->Username = 'egitim@pwc.com.tr';
				$mail->Password = '';
				$mail->SMTPAuth = false;
				$mail->SMTPAutoTLS = false; 
				$mail->Port = 25; 
			
				$mail->CharSet = 'utf-8'; 
				$mail->setFrom('egitim@pwc.com.tr', 'Business School');
				
				
				$mail->AddAddress('derya.akbulut@pwc.com');
				$mail->AddAddress('asli.sapanatan@pwc.com');
				$mail->AddAddress('sevilay.kilicaslan@pwc.com');
				// Name is optional
				$mail->addReplyTo($email, $adsoyad);		   
				$mail->setLanguage('tr', '/language');
				
				// Set email format to HTML
				$mail->Subject = 'Business School - İletişim Formu';
				$mail->msgHTML($body);
				if($mail->send()){
					echo $tebrik_mesaj;	
				} else {
					echo $hata_mesaj." - Mail Gönderilemedi.";
					
				}
				
				
				
				
			} else {
				echo $hata_mesaj;
			}
		}
	} else {
		echo '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu. Lütfen tüm bilgileri eksiksiz doldurunuz.</div>'; 
	}
?>
