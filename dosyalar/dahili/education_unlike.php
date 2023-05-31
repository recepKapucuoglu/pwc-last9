<?php require_once('_db.php'); 
	ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
	if($_POST['seo_url'] AND $_SESSION['dashboardUserId']) {
		
		// $edu_id = intval($_POST['id']);
		$seo_url = $_POST['seo_url'];
		$db->where('seo_url',$seo_url);
		$edu= $db->getOne('education');
		$edu_id=$edu['id'];

		$user_id = $_SESSION['dashboardUserId'];
		
		$db->where('edu_id', $edu_id);
		$db->where('user_id', $user_id);
		if($db->delete('web_user_favorite')) {
			
			echo getJson('ok', 'Eğitim favorilerinizden kaldırılmıştır.','',$edu_id);
			
		} else {
				echo getJson('error', 'Bir hata oluştu. Lütfen tekrar deneyiniz.');
			}

		
		
		
		
		
	} else {
		echo getJson('error', 'İçerik eksik olamaz.');
	}
?>
