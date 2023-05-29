<?php include('dosyalar/dahili/header.php');


require_once("dosyalar/dahili/libs/class.phpmailer.php");
require("dosyalar/dahili/libs/class.smtp.php");
require("dosyalar/dahili/libs/class.pop3.php"); 
if($_SESSION['katilimcilar']) {
	
	$oid = "PwC_".date("YmdHis");
	
	// Katılımcı Bilgileri
	$adsoyad[] = valueClear($_SESSION['katilimcilar']['katilimci_adsoyad']);
	$telefon[] = valueClear($_SESSION['katilimcilar']['katilimci_telefon']);
	$firma_telefon[] = valueClear($_SESSION['katilimcilar']['katilimci_firma_telefon']);
	$email[] = valueClear($_SESSION['katilimcilar']['katilimci_email']);
	$firma[] = valueClear($_SESSION['katilimcilar']['katilimci_firma']);
	$unvan[] = valueClear($_SESSION['katilimcilar']['katilimci_unvan']);
	$not = valueClear($_SESSION['katilimcilar']['katilimci_notu']);
	$edu_cal_id = intval($_SESSION['katilimcilar']['edu_cal_id']);
	$user_id = intval($_SESSION['katilimcilar']['user_id']);
	
	$adet = intval($_SESSION['katilimcilar']['adet']);
	
	$db->where("id",$edu_cal_id);
	$results = $db->get('education_calender');
	foreach ($results as $value) {
		$fiyat = $value['ucret'];
		$education_calender_uid = $value['uid'];
	}
	$adet = 1;
	$toplam_fiyat = ($fiyat * $adet) * 1.18;
	
	
	
	
	//Fatura Bilgileri
	$fatura_turu = valueClear($_SESSION['fatura_bilgileri']['fatura-turu']);
	$fatura_adsoyad = valueClear($_SESSION['fatura_bilgileri']['fatura_adsoyad']);
	$fatura_email = valueClear($_SESSION['fatura_bilgileri']['fatura_email']);
	$fatura_telefon = valueClear($_SESSION['fatura_bilgileri']['fatura_telefon']);
	$tc_no = valueClear($_SESSION['fatura_bilgileri']['tc_no']);
	$firma_unvani = valueClear($_SESSION['fatura_bilgileri']['firma_unvani']);
	$vergi_dairesi = valueClear($_SESSION['fatura_bilgileri']['vergi_dairesi']);
	$vergi_no = valueClear($_SESSION['fatura_bilgileri']['vergi_no']);
	$adres = valueClear($_SESSION['fatura_bilgileri']['adres']);
	
	
	//Daha önce form kaydedilmiş mi? Kontrol ediyoruz.
	$db->where('fatura_adi', $firma_unvani);
	$db->where('vergi_dairesi', $vergi_dairesi);
	$db->where('edu_cal_id', $edu_cal_id);
	$db->where('vergi_no', $vergi_no);
	$db->where('tutar', $toplam_fiyat);
	$formCount = $db->getValue ('education_order_form', "count(id)");
	// Eğer daha önce aynı bilgiler ile kayıt oluşturulmuşsa tebrik mesajı verilir
	if($formCount > 10) {
		echo "";
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
			'edu_cal_id' 		=> $edu_cal_id,
			'user_id' 		=> $user_id,
			'siparis_id' 		=> $oid,
			'fatura_adi' 		=> $firma_unvani, 
			'fatura_email' 		=> $fatura_email, 
			'fatura_telefon' 	=> $fatura_telefon, 
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
			$egitim_image = "http://www.okul.pwc.com.tr".$value['resim'];
			$sehir_adi = $value['sehir_adi'];
			$egitim_tarih = $value['egitim_tarih'];
			$egitim_type= $value['types'];
		}
		if($user_id>0){
			$db->where("id", $user_id);
			$results = $db->get('web_user');
			foreach ($results as $value) {
				$uye_email = $value['email'];
			}
		} else 
			$uye_email = "";
			
		
		
		$body="<html>
			<head>
		  <title>Business School - Satın Alma Formu - ".$egitim_adi." - ".$oid."</title>
		  <body>\n";
		$body.="<table rules='all' style='border-color: #666; font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#333;' cellpadding='10'>
		<thead><tr><td colspan='2'><b>FATURA BİLGİLERİ</b></td></tr></thead>";
		$body.="<tr><td width='150'><b>Fatura Tipi :</b></td><td>".$fatura_tipi."</td></tr>";
		$body.="<tr><td width='150'><b>Fatura Adı :</b></td><td>".$firma_unvani."</td></tr>";
		$body.="<tr><td width='150'><b>Fatura Email :</b></td><td>".$fatura_email."</td></tr>";
		$body.="<tr><td width='150'><b>Fatura Telefon :</b></td><td>".$fatura_telefon."</td></tr>";
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
				$body.="</table><br/>";
				$body.="<table rules='all' style='border-color: #666; font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#333;' cellpadding='10'>
				<thead><tr><td colspan='2'><b>NOT</b></td></tr></thead>";
				$body.="<tr><td colspan='2'>".$not."</td></tr>";
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
				//Bireysel
				$mail->Host = "smtp.gmail.com";
				$mail->Username = "rkapucuoglu@socialthinks.com";
				$mail->Password = 'Recep8990.';
				$mail->SMTPAuth = true;
				$mail->Port = 587;

				// used only when SMTP requires authentication  
				//$mail->SMTPAuth = true;

				//Prod
				//$mail->SMTPAuth = true; //geçersiz
				// $mail->Host = "10.9.18.5";
				// $mail->Username = 'egitim@pwc.com.tr';
				// $mail->Password = '';
				// $mail->SMTPAuth = false;
				// $mail->SMTPAutoTLS = false; 
				// $mail->Port = 25; 
			

				// $mail->Port = 25; 

				$mail->CharSet = 'utf-8'; 
				$mail->setFrom('egitim@pwc.com.tr', 'Business School');
				
				
				// $mail->AddAddress('derya.akbulut@pwc.com');
				// $mail->AddAddress('asli.sapanatan@pwc.com');
				// $mail->AddAddress('sevilay.kilicaslan@pwc.com');
				$mail->AddAddress('rkapucuoglu@socialthinks.com');
		
				// Name is optional
				$mail->addReplyTo($email, $adsoyad);		   
				$mail->setLanguage('tr', '/language');
				
				// Set email format to HTML
				$mail->Subject = 'Business School - Satın Alma Formu - '.$egitim_adi.' - '.$oid;
				$mail->msgHTML($body);
				if($mail->send()){
					
					
					// Kullanıcı Mail Gönderimi Başlıyor
					$getdata = http_build_query(
						array(
							'katilimcilar' => $_SESSION['katilimcilar'], 
							'egitim_adi' => $egitim_adi,
							'katilimci_sayisi' => $adet,
							'toplam_tutar' => $toplam_fiyat,
							'egitim_image' => $egitim_image,
							'egitim_tarihi' => date2Human($egitim_tarih),
							'kayit_numarasi' => $oid
							
						)
					);
					
					$opts = array('http' =>
					 array(
						'method'  => 'POST',
						'content' => $getdata
					)
					);
					$context  = stream_context_create($opts);

					if($egitim_type == 'E-Learning'){
						$body = file_get_contents('http://www.okul.pwc.com.tr/dosyalar/dahili/template/ozet_elearning.php?', false, $context);
					}
					else{$body = file_get_contents('http://www.okul.pwc.com.tr/dosyalar/dahili/template/ozet.php?', false, $context);
					}
					// Mail Gönderme 
					$mail = new PHPMailer;
					$mail->IsSMTP();

					//Prod
					// $mail->Host = "10.9.18.5";
					//// used only when SMTP requires authentication  
					////$mail->SMTPAuth = true;
					// $mail->Username = 'egitim@pwc.com.tr';
					// $mail->Password = '';
					//  $mail->SMTPAuth = false;
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
					
					$toplam_katilimci = count($_SESSION['katilimcilar']['katilimci_adsoyad']);
					if($user_id>0){
						$mail->AddAddress($uye_email);
					}						
					for($sayi = 0; $sayi < $toplam_katilimci; $sayi++) {
						if($uye_email<>$_SESSION['katilimcilar']['katilimci_email'][$sayi])
							$mail->AddAddress($_SESSION['katilimcilar']['katilimci_email'][$sayi]);
					}
					// Name is optional
					$mail->addReplyTo('egitim@pwc.com.tr', 'Business School');		   
					$mail->setLanguage('tr', '/language');
					
					// Set email format to HTML
					$mail->Subject = 'Business School - Kaydınız Tamamlandı';
					$mail->msgHTML($body);
					$mail->send();
					// Kullanıcı Mail Gönderimi Sonu
					
					$siparis_id = $oid;
					unset($_SESSION['katilimcilar']);
					unset($_SESSION['fatura_bilgileri']);
					
				} else {
					$siparis_id = "";
				}
				
				
			}else
				$siparis_id = "";
		} else 
			$siparis_id = "";
	}
}

$db->where('kayit_tarihi >= NOW() - INTERVAL 5 MINUTE');
$db->where('siparis_id', $siparis_id);
$results = $db->get('education_order_form_list');
foreach ($results as $value) {
	$resim=$value['resim'];
	$resim_alt_etiket=$value['resim_alt_etiket'];
	$egitim_tarih=$value['egitim_tarih'];
	$egitim_adi=$value['egitim_adi'];
	$tutar=$value['tutar'];
	$katilimci_sayisi=$value['katilimci_sayisi'];
	$order_id=$value['id'];
	$siparis_id=$value['siparis_id'];
}

if($order_id<>"") {
?>
	<section id="sayfaust" style="background-image:url(dosyalar/images/sayfaust-bg.jpg);">
		<div class="basliklar">
			<div class="baslik">EĞİTİM KAYIT FORMU</div>
			<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="/"><span itemprop="name">Anasayfa</span></a>
					<meta itemprop="position" content="1" />
				</li>
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="egitimlerimiz.php"><span itemprop="name">Eğitimlerimiz</span></a>
					<meta itemprop="position" content="2" />
				</li>
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="<?php echo $seo_url; ?>"><span itemprop="name"><?php echo $egitim_adi; ?></span></a>
					<meta itemprop="position" content="3" />
				</li>
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="#"><span itemprop="name">Kayıt Formu</span></a>
					<meta itemprop="position" content="2" />
				</li>
			</ol>
		</div>
	</section>
	<section class="ortakisim">
		<form action="#" class="sepetform">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="sepet-div">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<center>
										<i class="far fa-check-circle"></i>
										<h3><b>Kayıt Tamamlandı</b></h3>
										<h3><strong>Kayıt Numarası: <?php echo $siparis_id; ?></strong></h3>
										<h3><br/><strong>Kaydınız tarafımıza ulaşmıştır. Eğitim katılım linki ve ödeme bilgileri katılımcıya mail ile iletilecektir.</strong></h3>
									</center>
									
									<br />
									<br />
									<table class="tablesepet sepetlist sepetozeti">
										<tbody>
											<tr>
												<div id="education_calender_uid" style="display: none;" data-uid="<?php echo $education_calender_uid; ?>"></div>
												<td>
													<div class="urunkutusu">
														<div class="resim"><img src="<?php echo $site_url.$resim; ?>" alt="<?php echo $resim_alt_etiket; ?>" /></div>
														<div class="adi"><?php echo $egitim_adi; ?><br /><small>Eğitim Tarihi: <?php echo date2Human($egitim_tarih); ?></small></div>
													</div>
												</td>
												<td><?php echo $katilimci_sayisi; ?> Adet</td>
												<td>
													<div class="fiyat">
														<b><?php echo number_format($tutar, 2, ',', '.'); ?> TL</b>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
									<br />
									<br />
									
									<center>
										<h3><b>Katılımcı Bilgileri</b></h3>
										<table class="katilimcitablo">
											<thead>
												<tr>
													<th>Ad Soyad</th>
													<th>Telefon</th>
													<th>E-Mail</th>
												</tr>
											</thead>
											<tbody>
												<?php 
												$db->where('order_id', $order_id);
												$results = $db->get('education_order_person');
												foreach ($results as $value) {
												?>
												<tr>
													<td><?php echo $value['adsoyad']; ?></td>
													<td><?php echo $value['telefon']; ?></td>
													<td><?php echo $value['email']; ?></td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
								
										
									</center>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
	<script>
        window.dataLayer = window.dataLayer || [];
		window.dataLayer.push({
		   'event': 'purchase',
		   'transactionId': '<?php echo $siparis_id; ?>',

		   'transactionTotal': <?php echo $tutar; ?>,
		   'transactionProducts': [{
			   'sku': '<?php echo $education_calender_uid; ?>',

			   'name': '<?php echo $egitim_adi; ?>',

			   'price': <?php echo $tutar; ?>,
			   'quantity': <?php echo $katilimci_sayisi; ?>
		   }]
		});

</script>

<?php } else { header("Location: https://www.okul.pwc.com.tr"); } ?>
<?php include('dosyalar/dahili/footer.php');?>