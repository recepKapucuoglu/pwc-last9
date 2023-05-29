<?php
	require_once("inc.php");
	ini_set("display_errors",1); 
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	 
	require_once("libs/class.phpmailer.php");
	require("libs/class.smtp.php");
	require("libs/class.pop3.php"); 
	$i=0;
	

	
	
	// Talepleri döngü ile çeviriyoruz.
	$db->where("mail", 0);
	$results = $db->get('platform_form');
	
	foreach ($results as $value) {
		
		$fatura_adi = $value['fatura_adi'];
		$vergi_dairesi = $value['vergi_dairesi'];
		$vergi_no = $value['vergi_no'];
		$adres = $value['adres'];
		$fatura_tipi = $value['fatura_tipi'];
		$kayit_tarihi = $value['kayit_tarihi'];
		$kayit_id = $value['id'];
		
		
		$body="<html>
			<head>
		  <title>18. Çözüm Ortaklığı Platformu Talep Formu</title>
		  <body>\n";
		$body.="<table rules='all' style='border-color: #666; font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#333;' cellpadding='10'>
		<thead><tr><td colspan='2'><b>FATURA BİLGİLERİ</b></td></tr></thead>";
		$body.="<tr><td width='150'><b>Fatura Tipi :</b></td><td>".$fatura_tipi."</td></tr>";
		
		if($fatura_tipi=="Bireysel"){
			$body.="<tr><td width='150'><b>Fatura Adı :</b></td><td>".$fatura_adi."</td></tr>";
			$body.="<tr><td width='150'><b>T.C. No :</b></td><td>".$vergi_no."</td></tr>";
		} else {
			$body.="<tr><td width='150'><b>Firma Unvanı :</b></td><td>".$fatura_adi."</td></tr>";
			$body.="<tr><td width='150'><b>Vergi Dairesi :</b></td><td>".$vergi_dairesi."</td></tr>";
			$body.="<tr><td width='150'><b>Vergi No :</b></td><td>".$vergi_no."</td></tr>";
		}
		$body.="<tr><td width='150'><b>Adres :</b></td><td>".$adres."</td></tr></table><br/>";
		
		$body.="<table rules='all' style='border-color: #666; font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#333;' cellpadding='10'>
		<thead><tr><td colspan='2'><b>KATILIMCI BİLGİLERİ</b></td></tr></thead>";
		
		$kayit = 0;
		$db->where("form_id", $kayit_id);
		$resultsKayit = $db->get('platform_katilimci');
		foreach ($resultsKayit as $valueKayit) {
			if($valueKayit['alumni']==1)
				$alumni = "Evet (".$valueKayit['alumni_yil'].")";
			else
				$alumni = "Hayır";
			$kayit++;
			if($kayit==1){
				$email = $valueKayit['email']; 
				$adsoyad = $valueKayit['adsoyad'];
			}
			$body.="<tr><td colspan='2'><b>".$kayit.". Katılımcı Bilgileri</b></td></tr>";
			$body.="<tr><td width='150'><b>Ad Soyad :</b></td><td>".$valueKayit['adsoyad']."</td></tr>";
			$body.="<tr><td width='150'><b>Unvan :</b></td><td>".$valueKayit['unvan']."</td></tr>";
			$body.="<tr><td width='150'><b>Firma :</b></td><td>".$valueKayit['firma']."</td></tr>";
			$body.="<tr><td width='150'><b>Telefon :</b></td><td>".$valueKayit['telefon']."</td></tr>";
			$body.="<tr><td width='150'><b>E-mail :</b></td><td>".$valueKayit['email']."</td></tr>";
			$body.="<tr><td width='150'><b>Gsm :</b></td><td>".$valueKayit['gsm']."</td></tr>";
			$body.="<tr><td width='150'><b>Workshop 1 (09:00 - 09:45) :</b></td><td>".$valueKayit['workshop_1']."</td></tr>";
			$body.="<tr><td width='150'><b>Workshop 2 (12:00 - 12:45) :</b></td><td>".$valueKayit['workshop_2']."</td></tr>";
			$body.="<tr><td width='150'><b>Workshop 3 (15:45 - 16:30) :</b></td><td>".$valueKayit['workshop_3']."</td></tr>";
			$body.="<tr><td width='150'><b>Katılımcı Not :</b></td><td>".$valueKayit['katilimci_not']."</td></tr>";
			$body.="<tr><td width='150'><b>Eski PwC Çalışanı :</b></td><td>".$alumni."</td></tr>";
		}

		$body.="</table><br/>";
		$body.="</body></head></html>";
		
		
	
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
		$mail->setFrom('egitim@pwc.com.tr', '18. Çözüm Ortaklığı Platformu');
		



		$mail->AddAddress('derya.akbulut@pwc.com');
		$mail->AddAddress('asli.sapanatan@pwc.com');
		$mail->AddAddress('sevilay.kilicaslan@pwc.com');
		//$mail->AddAddress('serdar.mangaoglu@pwc.com');
		// Name is optional
		$mail->addReplyTo($email, $adsoyad);		   
		$mail->setLanguage('tr', '/language');
		
		// Set email format to HTML
		$mail->Subject = '18. Çözüm Ortaklığı Platformu - Kayıt Formu';
		$mail->msgHTML($body);
		if($mail->send()){
			$data = Array ('mail' => 1);
			$db->where('id', $kayit_id);
			$id = $db->update ('platform_form', $data);
			echo $i." ".$adsoyad." gönderildi.<br/>";
		} else {
			echo $i." ".$adsoyad." GÖNDERİLEMEDİ. HATA!<br/>";
			var_dump($mail);
			die();
			
		}
		
		
		
		
		
		
	}
	
?>
