<?php
	require_once("inc.php");
	$hata_mesaj =  '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.</div>'; 
	$tebrik_mesaj =  '<div class="alert alert-success"><strong>Teşekkürler!</strong> E-bülten aboneliğiniz başarıyla gerçekleşmiştir. </div>'; 
	
	if($_POST['email']) {
		$email = valueClear($_POST['email']);
		
		
		//Daha önce form kaydedilmiş mi? Kontrol ediyoruz.
		$db->where('email', $email);
		$formCount = $db->getValue ('newsletter', "count(id)");
		// Eğer daha önce aynı bilgiler ile kayıt oluşturulmuşsa tebrik mesajı verilir
		if($formCount > 0) {
			echo $tebrik_mesaj;
		} else { 
		
			// eğer kayıt yoksa kayıt yapılarak entegrasyon yapılır.
			$data = Array (
				'id' 				=> NULL,
				'email' 			=> $email, 
				'kayit_tarihi' 		=> $db->now()
			);
			
			$formKayit = $db->insert ('newsletter', $data);
			// Kayıt başarılıysa
			if ($formKayit) {
				echo $tebrik_mesaj;	
			} else {
				echo $hata_mesaj;
			}
		}
	} else {
		echo '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu. Lütfen tüm bilgileri eksiksiz doldurunuz.</div>'; 
	}
?>
