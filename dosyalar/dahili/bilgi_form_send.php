<?php
	require_once("inc.php");
	
	require_once("libs/class.phpmailer.php");
	require("libs/class.smtp.php");
	require("libs/class.pop3.php"); 
	$hata_mesaj =  '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.</div>'; 
	$tebrik_mesaj =  '<div class="alert alert-success"><strong>Teşekkürler!</strong> Formunuz bize ulaşmıştır. Business School ekibimiz en kısa sürede sizinle iletişime geçecektir. Hizmetlerimize gösterdiğiniz ilgi için teşekkür ederiz. </div>'; 
	
	if($_POST['adsoyad']) {
		$adsoyad = valueClear($_POST['adsoyad']);
		$telefon = clearPhone($_POST['telefon']);
		$sirketadi = valueClear($_POST['sirketadi']);
		$email = valueClear($_POST['email']);
		$edu_id = intval($_POST['edu_id']);
		$edu_cal_id = intval($_POST['edu_cal_id']);
		
		$kontenjan = intval($_POST['kontenjan']);
		$ozel = intval($_POST['ozel']);
		$katilim = intval($_POST['katilim']);
		$duyuru = intval($_POST['duyuru']);
		$diger = valueClear($_POST['diger']);
		
		
		
		$kisi_sayisi = valueClear($_POST['kisi_sayisi']);
		$lokasyon = valueClear($_POST['lokasyon']);
		$egitim_konu = valueClear($_POST['egitim_konu']);
		
		
		//Daha önce form kaydedilmiş mi? Kontrol ediyoruz.
		$db->where('adsoyad', $adsoyad);
		$db->where('edu_id', $edu_id);
		$db->where('edu_cal_id', $edu_cal_id);
		$db->where('telefon', $telefon);
		$db->where('email', $email);
		$formCount = $db->getValue ('education_info_form', "count(id)");
		// Eğer daha önce aynı bilgiler ile kayıt oluşturulmuşsa tebrik mesajı verilir
		if($formCount > 0) {
			echo $tebrik_mesaj;
		} else { 
		
			// eğer kayıt yoksa kayıt yapılarak entegrasyon yapılır.
			$data = Array (
				'id' 				=> NULL,
				'edu_id' 			=> $edu_id, 
				'edu_cal_id' 		=> $edu_cal_id,
				'adsoyad' 			=> $adsoyad,
				'telefon' 			=> $telefon,
				'email' 			=> $email,			
				'sirket' 			=> $sirketadi,
				'diger' 			=> $diger,
				'kontenjan' 		=> $kontenjan,
				'duyuru' 			=> $duyuru,
				'ozel' 				=> $ozel,
				'katilim' 			=> $katilim,
				'kisi_sayisi' 			=> $kisi_sayisi,
				'lokasyon' 			=> $lokasyon,
				'egitim_konu' 			=> $egitim_konu,
				'kayit_tarihi' 		=> $db->now()
			);
			if($edu_id<>""){
				$db->where("id", $edu_id);
				$results = $db->get('education_list');
				foreach ($results as $value) {
					$egitim_adi = $value['baslik'];
				}
				
				if($kontenjan==1) $kontenjan_bilgisi = "Evet"; else $kontenjan_bilgisi = "Hayır";
				if($ozel==1) $ozel_bilgisi = "Evet"; else $ozel_bilgisi = "Hayır";
				if($katilim==1) $katilim_bilgisi = "Evet"; else $katilim_bilgisi = "Hayır";
				if($duyuru==1) $duyuru_bilgisi = "Evet"; else $duyuru_bilgisi = "Hayır";
			} else{
				$egitim_adi = "Özel Eğitim";
			}
			
			
			$formKayit = $db->insert ('education_info_form', $data);
			
			// Kayıt başarılıysa
			if ($formKayit) {
				
				$body="<html>
					<head>
				  <title>Business School Bilgi Formu ".$egitim_adi."</title>
				  <body>\n";
				$body.="<table rules='all' style='border-color: #666; font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#333;' cellpadding='10'>
				<thead><tr><td colspan='2'><b>KAYIT BİLGİLERİ</b></td></tr></thead>";
				$body.="<tr><td width='150'><b>Ad Soyad :</b></td><td>".$adsoyad."</td></tr>";
				$body.="<tr><td width='150'><b>Telefon :</b></td><td>".$telefon."</td></tr>";
				$body.="<tr><td width='150'><b>Email :</b></td><td>".$email."</td></tr>";
				$body.="<tr><td width='150'><b>Şirket :</b></td><td>".$sirketadi."</td></tr>";
				$body.="<tr><td width='150'><b>Detay :</b></td><td>".$diger."</td></tr>";
				if($edu_id<>""){
					
					$body.="<tr><td width='150'><b>Eğitim Adı :</b></td><td>".$egitim_adi."</td></tr>";
					$body.="<tr><td width='150'><b>Bu eğitim için kontenjan açıldığında haberdar olmak istiyorum. :</b></td><td>".$kontenjan_bilgisi."</td></tr>";
					$body.="<tr><td width='150'><b>Bu eğitimi çalıştığım şirket için özel olarak düzenlemek istiyorum. :</b></td><td>".$ozel_bilgisi."</td></tr>";
					$body.="<tr><td width='150'><b>Bu eğitim için katılıma açık bir tarih belirlendiğinde haberdar olmak istiyorum. :</b></td><td>".$katilim_bilgisi."</td></tr>";
					$body.="<tr><td width='150'><b>PwC Business School duyurularından haberdar olmak istiyorum. :</b></td><td>".$duyuru_bilgisi."</td></tr>";
				} else {
					$body.="<tr><td width='150'><b>Eğitim Konusu :</b></td><td>".$egitim_konu."</td></tr>";
					$body.="<tr><td width='150'><b>Eğitim Lokasyon :</b></td><td>".$lokasyon."</td></tr>";
					$body.="<tr><td width='150'><b>Eğitim Kişi Sayısı :</b></td><td>".$kisi_sayisi."</td></tr>";
				}
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
				$mail->Subject = 'Business School - Bilgi Formu - '.$egitim_adi;
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
