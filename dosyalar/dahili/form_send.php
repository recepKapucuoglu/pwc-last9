<?php
	require_once("inc.php");
	require_once("libs/class.phpmailer.php");
	require("libs/class.smtp.php");
	require("libs/class.pop3.php"); 
	$hata_mesaj = "<div class=\"alert alert-warning\"><strong>Bir hata oluştu!</strong> Lütfen daha sonra tekrar deneyiniz. </div>";
	$tebrik_mesaj = "<div class=\"alert alert-success\">Kaydınız tarafımıza ulaşmştır. Eğitim yeri ve ödeme ile bilgiler eğitim tarihinden en az 3 iş günü öncesine kadar tarafınıza e-posta yoluyla bildirilecektir.  </div>";
	
	if($_POST['katilimci_adsoyad']) {
		
		$oid = "PwC_".date("YmdHis");
		// Katılımcı Bilgileri
		$adsoyad[] = valueClear($_POST['katilimci_adsoyad']);
		$telefon[] = valueClear($_POST['katilimci_telefon']);
		$firma_telefon[] = valueClear($_POST['katilimci_firma_telefon']);
		$email[] = valueClear($_POST['katilimci_email']);
		$firma[] = valueClear($_POST['katilimci_firma']);
		$unvan[] = valueClear($_POST['katilimci_unvan']);
		$not = valueClear($_POST['katilimci_notu']);
		$edu_cal_id = intval($_POST['edu_cal_id']);
		
		$adet = intval($_POST['adet']);
		
		$db->where("id",$edu_cal_id);
		$results = $db->get('education_calender');
		foreach ($results as $value) {
			$fiyat = $value['ucret'];
		}

		$toplam_fiyat = $fiyat * $adet;
		
		
		
		
		//Fatura Bilgileri
		$fatura_turu = valueClear($_POST['fatura-turu']);
		$fatura_adsoyad = valueClear($_POST['fatura_adsoyad']);
		$tc_no = valueClear($_POST['tc_no']);
		$firma_unvani = valueClear($_POST['firma_unvani']);
		$vergi_dairesi = valueClear($_POST['vergi_dairesi']);
		$vergi_no = valueClear($_POST['vergi_no']);
		$adres = valueClear($_POST['adres']);
		
		
		//Daha önce form kaydedilmiş mi? Kontrol ediyoruz.
		$db->where('fatura_adi', $firma_unvani);
		$db->where('vergi_dairesi', $vergi_dairesi);
		$db->where('edu_cal_id', $edu_cal_id);
		$db->where('vergi_no', $vergi_no);
		$db->where('tutar', $toplam_fiyat);
		$formCount = $db->getValue ('education_order_form', "count(id)");
		// Eğer daha önce aynı bilgiler ile kayıt oluşturulmuşsa tebrik mesajı verilir
		if($formCount > 0) {
			echo $tebrik_mesaj;
		} else { 
		
			if($fatura_turu==1){
				$fatura_tipi = "Bireysel";
				$vergi_no = $tc_no;
				$firma_unvani = $fatura_adsoyad;
			} else{
				$fatura_tipi = "Kurumsal";
			}

			// Fatura bilgileri
			$data = Array (
				'id' 				=> NULL,
				'edu_cal_id' 		=> $edu_cal_id,
				'siparis_id' 		=> $oid,
				'fatura_adi' 		=> $firma_unvani, 
				'vergi_dairesi' 	=> $vergi_dairesi,
				'vergi_no' 			=> $vergi_no,				
				'adres' 			=> $adres,
				'fatura_tipi' 		=> $fatura_tipi,
				'tutar' 			=> $toplam_fiyat,
				'katilimci_sayisi' 	=> $adet,
				'not' 				=> $not,
				'kayit_tarihi' 		=> $db->now(),
				'ipaddress' 		=> $_SERVER['REMOTE_ADDR']
			);
			
			$db->where("id", $edu_cal_id);
			$results = $db->get('education_calender_list');
			foreach ($results as $value) {
				$egitim_adi = $value['egitim_adi'];
				$sehir_adi = $value['sehir_adi'];
				$egitim_tarih = $value['egitim_tarih'];
			}
			
			$body="<html>
				<head>
			  <title>PWC Okul - Satın Alma Formu - ".$egitim_adi." - ".$oid."</title>
			  <body>\n";
			$body.="<table rules='all' style='border-color: #666; font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#333;' cellpadding='10'>
			<thead><tr><td colspan='2'><b>FATURA BİLGİLERİ</b></td></tr></thead>";
			$body.="<tr><td width='150'><b>Fatura Tipi :</b></td><td>".$fatura_tipi."</td></tr>";
			$body.="<tr><td width='150'><b>Fatura Adı :</b></td><td>".$fatura_adi."</td></tr>";
			if($fatura_tipi=="Bireysel"){
				$body.="<tr><td width='150'><b>T.C. No :</b></td><td>".$vergi_no."</td></tr>";
			} else {
				$body.="<tr><td width='150'><b>Vergi Dairesi :</b></td><td>".$vergi_dairesi."</td></tr>";
				$body.="<tr><td width='150'><b>Vergi No :</b></td><td>".$vergi_no."</td></tr>";
			}
			$body.="<tr><td width='150'><b>Adres :</b></td><td>".$adres."</td></tr></table><br/>";
			
			$body.="<table rules='all' style='border-color: #666; font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#333;' cellpadding='10'>
			<thead><tr><td colspan='2'><b>KATILIMCI BİLGİLERİ</b></td></tr></thead>";
			
			$kayit = 0;
			$formKayit = $db->insert('education_order_form', $data);
			
			// Kayıt başarılıysa kayıt bilgilerini alıyoruz.
			if ($formKayit){
				
				if($adet>0){
					for($sayi = 0; $sayi < $adet; $sayi++) {
						$kayit++;
						$dataKatilimci = Array (
							'id' 				=> NULL,
							'order_id' 			=> $formKayit, 
							'edu_cal_id' 		=> $edu_cal_id, 
							'adsoyad' 			=> valueClear($adsoyad[0][$sayi]),
							'telefon' 			=> valueClear($telefon[0][$sayi]),
							'email' 			=> valueClear($email[0][$sayi]),
							'firma' 			=> valueClear($firma[0][$sayi]),
							'unvan' 			=> valueClear($unvan[0][$sayi]),
							'firma_telefon' 	=> valueClear($firma_telefon[0][$sayi])
						);
						$formKatilimci = $db->insert('education_order_person', $dataKatilimci);
						
						$body.="<tr><td colspan='2'><b>".$kayit.". Katılımcı Bilgileri</b></td></tr>";
						$body.="<tr><td width='150'><b>Ad Soyad :</b></td><td>".$adsoyad[0][$sayi]."</td></tr>";
						$body.="<tr><td width='150'><b>Unvan :</b></td><td>".$unvan[0][$sayi]."</td></tr>";
						$body.="<tr><td width='150'><b>Firma :</b></td><td>".$firma[0][$sayi]."</td></tr>";
						$body.="<tr><td width='150'><b>Firma Telefon :</b></td><td>".$firma_telefon[0][$sayi]."</td></tr>";
						$body.="<tr><td width='150'><b>Telefon :</b></td><td>".$telefon[0][$sayi]."</td></tr>";
						$body.="<tr><td width='150'><b>E-mail :</b></td><td>".$email[0][$sayi]."</td></tr>";
						
						
						
					}
				}
				
				
				if ($formKatilimci){
					$body.="<tr><td width='150'><b>Not :</b></td><td>".$not."</td></tr>";
					$body.="</table><br/>";
					$body.="<table rules='all' style='border-color: #666; font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#333;' cellpadding='10'>
					<thead><tr><td colspan='2'><b>EĞİTİM BİLGİLERİ</b></td></tr></thead>";
					$body.="<tr><td width='150'><b>Eğitim Adı :</b></td><td>".$egitim_adi."</td></tr>";
					$body.="<tr><td width='150'><b>Şehir :</b></td><td>".$sehir_adi."</td></tr>";
					$body.="<tr><td width='150'><b>Eğitim Tarihi :</b></td><td>".date2Human($egitim_tarih)."</td></tr>";
					
					
					
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
					$mail->Subject = 'Business School - Satın Alma Formu - '.$egitim_adi.' - '.date2Human($egitim_tarih);
					$mail->msgHTML($body);
					if($mail->send()){
						header("Location: https://www.okul.pwc.com.tr/sepet-sonuc/".$oid);
						echo $tebrik_mesaj;	
					} else {
						echo $hata_mesaj." - Mail Gönderilemedi.";
						
					}
					
					
				}else
					echo $hata_mesaj;
			} else 
				echo $hata_mesaj;
		}
	} else {
		echo "<div class=\"alert alert-warning\"><strong>Uyarı!</strong> Lütfen bilgileri eksiksiz doldurunuz.</div>";
	}
?>
