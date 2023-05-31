<?php require_once('_db.php'); 
	ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
	if($_POST['id'] AND $_SESSION['dashboardUserId']) {
		$edu_id = intval($_POST['id']);
		 $user_id = $_SESSION['dashboardUserId'];
		
		$today = date("Y-m-d", time() - 86400);
		//Daha önce form kaydedilmiş mi? Kontrol ediyoruz.
		$db->where('user_id', $user_id);
		$db->where('edu_id', $edu_id);
		$formCount = $db->getValue ('web_user_favorite', "count(id)");
		
		// Eğer daha önce aynı bilgiler ile kayıt oluşturulmuşsa tebrik mesajı verilir
		if($formCount > 0) {
			echo getJson('error', 'Bu eğitimi favorilerinizden kaldırmak için, hesabım bölümündeki Favorilerim bölümünden işlem yapmanız gerekmektedir.');
		} else { 
	
			$data = Array (
				'id' 				=> NULL,
				'user_id' 			=> $user_id,
				'edu_id' 			=> $edu_id, 
				'created_date' 		=> $db->now()
			);

			
			$formKayit = $db->insert ('web_user_favorite', $data);
		
			// Kayıt başarılıysa
			if ($formKayit) {
				echo getJson('ok', 'Eğitim favorilerinize eklenmiştir.','', $edu_id);
			} else {
				echo getJson('error', 'Bir hata oluştu. Lütfen tekrar deneyiniz.');
			}

		}
		
		
		
		
	} else {
		echo getJson('error', 'İçerik eksik olamaz.');
	}
?>
