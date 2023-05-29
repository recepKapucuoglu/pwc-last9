<?php 
session_start();

if ($_SESSION['useradmin'])
{
	include('_function.php');
	$ipler = array('213.74.59.98','213.74.20.182','85.96.88.60','82.222.18.170','91.93.169.116','88.235.30.53','176.40.255.250','127.0.0.1');
	$kimlik = GetIP();
	$giris_ip = 0;
	foreach($ipler as $ban){
		if($ban == $kimlik){
			$giris_ip = 1;
		}
	}
	if($giris_ip <> 1){
		header('Location: https://www.okul.pwc.com.tr/');exit();
	}
require_once("libs/MysqliDb.php");
require_once("libs/dbObject.php");

// db instance
// $db = new Mysqlidb('10.9.18.4', 'business_school', '2KCkYMmm%;f!', 'school');
$db = new Mysqlidb('localhost','root','','school');

// enable class autoloading
dbObject::autoload("models");	
	

$db->where('email', $_SESSION['useradmin']);
$results = $db->get('netia_admin');
foreach ($results as $value) {
	$usr_surname =  $value['surname'];
	$usr_name =  $value['name'];
	$usr_email =  $value['email'];
	$usr_title =  $value['title'];
	$usr_id =  $value['id'];
}

	$db->where('id', 1);
	$results = $db->get('settings');
	foreach ($results as $value) {
		$customer_name =  $value['cust_name'];
	}
	//Aylık Chart rakamlarını çekiyoruz.
	$chartRow = chartAylik();
	$chartRowTutar =chartAylikTutar();

	// Toplam Rakamları Çekiyoruz
	$totalBilgi = totalForm('education_info_form','kayit_tarihi');
	
	$totalSatinAlma = totalForm('education_order_person_list','kayit_tarihi');
	
	$results = $db->get('education_total');
	foreach ($results as $value) {
		$toplam_egitim_tutar =  $value['toplam_tutar'];
		$toplam_egitim_tutar_odenen=$value['toplam_odenen_tutar'];
	}
	
	
	$egitimSayisi['total'] = $db->getValue ('education', "count(id)");
	
	$dateToday = date("Y-m-d");
	$db->where('durum', 1);
	$db->where('egitim_tarih',$dateToday,'>=');
	$egitimSayisi['aktif'] = $db->getValue ('education_calender', "count(id)");
	
	$db->where('durum', 1);
	$db->where('egitim_tarih',$dateToday,'>=');
	$aktifEgitimKatilim['toplam_katilimci'] = $db->getValue ('education_calender', "sum(katilimci_sayisi)");
	
	
	
	$db->where('durum', 1);
	$db->where('egitim_tarih',$dateToday,'>=');
	$aktifEgitimKatilim['toplam_talep'] = $db->getValue ('education_order_person_list', "count(id)");
	
	$aktifEgitimKatilim['oran'] = $aktifEgitimKatilim['toplam_talep'] / $aktifEgitimKatilim['toplam_katilimci'] * 100;
	
	$db->where('edu_cal_id', 0);
	$bilgiTalebi['sirket'] = $db->getValue ('education_info_form', "count(id)");
	
	$bilgiTalebi['egitim'] = $totalBilgi['total'] - $bilgiTalebi['sirket'];
	
} else {
?>	
<script>
	location.href="login.php";
</script>    
<?php } ?>

