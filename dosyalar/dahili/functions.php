<?php
require_once('_db.php'); 
function egitimler_db(){
	global $db;
	$dateToday = date("Y-m-d");
	$egitimSayac=0;
	/*$db->where('durum', 1);
	$db->where('egitim_tarih',$dateToday,'>=');*/
	$db->orderBy("egitim_tarih","asc");
	$resultsCalender = $db->get('education_calender_list');
	$egitimAy = "";
	foreach ($resultsCalender as $valueCalender) { 
		
		$egitimTarih = calenderDate($valueCalender['egitim_tarih']);
		$seoURL = $valueCalender['seo_url'];
		$durum = $valueCalender['durum'];
		if($durum<>1)
			$seoURL = "";
		if($valueCalender['egitim_tarih']<=$dateToday)
			$seoURL = "";
		
		$egitimDetay = array(
			'groupId' => $egitimTarih,
			'title' => t_decode($valueCalender['egitim_adi']),	
			'start' => $valueCalender['egitim_tarih'].'T'.$valueCalender['baslangic_saat'],	
			'end' => $valueCalender['egitim_tarih'].'T'.$valueCalender['bitis_saat'],	
			'id' => $valueCalender['id'],
			'url' => $seoURL,
			'ozet' => t_decode($valueCalender['kisa_aciklama']),
			'yer' => $valueCalender['sehir_adi'],
		);
		
		$egitimAy = substr($egitimTarih,0,6);
		$egitimler[$egitimAy][] = $egitimDetay;
		
	}
	
	return $egitimler;
}



?>