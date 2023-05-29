<?php
	require_once("inc.php");
	$hata_mesaj = "<div class=\"alert alert-warning\"><strong>Bir hata oluştu!</strong> Lütfen daha sonra tekrar deneyiniz. </div>";
	$tebrik_mesaj = "<div class=\"alert alert-success\">Formunuz bize ulaşmıştır. Business School ekibimiz en kısa sürede sizinle iletişime geçecektir. 18. Çözüm Ortaklığı Platformu'na gösterdiğiniz ilgi için teşekkür ederiz. </div>";
	
	if($_POST['adsoyad']) {
		
		// Katılımcı Bilgileri
		$adsoyad = valueClear($_POST['adsoyad']);
		$unvan = valueClear($_POST['unvan']);
		$firma_adi = valueClear($_POST['firma_adi']);
		$telefon = valueClear($_POST['telefon']);
		$email = valueClear($_POST['email']);
		$gsm = valueClear($_POST['gsm']);
		$workshop_1 = valueClear($_POST['workshop_1']);
		$workshop_2 = valueClear($_POST['workshop_2']);
		$workshop_3 = valueClear($_POST['workshop_3']);
		
		$adet = intval($_POST['adet']);
		
		
		
		
		//Fatura Bilgileri
		$fatura_turu = valueClear($_POST['fatura-turu']);
		$fatura_adsoyad = valueClear($_POST['fatura_adsoyad']);
		$tc_no = valueClear($_POST['tc_no']);
		$firma_unvani = valueClear($_POST['firma_unvani']);
		$vergi_dairesi = valueClear($_POST['vergi_dairesi']);
		$vergi_no = valueClear($_POST['vergi_no']);
		$adres = valueClear($_POST['adres']);
		
		
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
			'fatura_adi' 		=> $firma_unvani, 
			'vergi_dairesi' 	=> $vergi_dairesi,
			'vergi_no' 			=> $email,				
			'adres' 			=> $adres,
			'fatura_tipi' 		=> $fatura_tipi,
			'kayit_tarihi' 		=> $db->now(),
			'ipaddress' 		=> $_SERVER['REMOTE_ADDR']
		);
		
		$formKayit = $db->insert('platform_form', $data);
		
		// Kayıt başarılıysa kayıt bilgilerini alıyoruz.
		if ($formKayit){
			// Fatura bilgileri
			$dataKatilimci = Array (
				'id' 				=> NULL,
				'form_id' 			=> $formKayit, 
				'adsoyad' 			=> $adsoyad,
				'unvan' 			=> $unvan,				
				'firma' 			=> $firma_adi,
				'telefon' 			=> $telefon,
				'email' 			=> $email,
				'gsm' 				=> $gsm,
				'workshop_1' 		=> $workshop_1,
				'workshop_2' 		=> $workshop_2,
				'workshop_3' 		=> $workshop_3,
				'katilimci_not' 	=> valueClear($_POST['not']),
				'alumni' 			=> valueClear($_POST['alumni']),
				'alumni_yil' 		=> valueClear($_POST['alumni_yil']),
				'kayit_tarihi' 		=> $db->now()
			);
			$formKatilimci = $db->insert('platform_katilimci', $dataKatilimci);
			
			// Toplu katılımcılar kayıt ediliyor.
			if($adet>1){
				for($sayi = 2; $sayi <= $adet; $sayi++) {
					$dataKatilimci = Array (
						'id' 				=> NULL,
						'form_id' 			=> $formKayit, 
						'adsoyad' 			=> valueClear($_POST['katilimci_adsoyad'][$sayi]),
						'unvan' 			=> valueClear($_POST['katilimci_unvan'][$sayi]),				
						'firma' 			=> valueClear($_POST['katilimci_firma_adi'][$sayi]),
						'telefon' 			=> valueClear($_POST['katilimci_telefon'][$sayi]),
						'email' 			=> valueClear($_POST['katilimci_email'][$sayi]),
						'gsm' 				=> valueClear($_POST['katilimci_gsm'][$sayi]),
						'workshop_1' 		=> valueClear($_POST['katilimci_workshop_1'][$sayi]),
						'workshop_2' 		=> valueClear($_POST['katilimci_workshop_2'][$sayi]),
						'workshop_3' 		=> valueClear($_POST['katilimci_workshop_3'][$sayi]),
						'katilimci_not' 	=> valueClear($_POST['katilimci_not'][$sayi]),
						'alumni' 			=> valueClear($_POST['katilimci_alumni'][$sayi]),
						'alumni_yil' 		=> valueClear($_POST['katilimci_alumni_yil'][$sayi]),
						'kayit_tarihi' 		=> $db->now()
					);
					$formKatilimci = $db->insert('platform_katilimci', $dataKatilimci);
				}
			}
			
			if ($formKatilimci){
				echo $tebrik_mesaj; echo "<script>document.getElementById(\"contact-form\").reset();</script>";
			}else
				echo $hata_mesaj;
		} else 
			echo $hata_mesaj;
				
	} else {
		echo "<div class=\"alert alert-warning\"><strong>Uyarı!</strong> Lütfen bilgileri eksiksiz doldurunuz.</div>";
	}
?>
