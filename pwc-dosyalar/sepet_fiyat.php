<?php 
require_once('_db.php');
$katilimci = intval($_GET['katilimci']);
$edu_cal_id = intval($_GET['edu_cal_id']);

$db->where("id",$edu_cal_id);
$results = $db->get('education_calender');
foreach ($results as $value) {
	$fiyat = $value['ucret'];
}

$toplam_fiyat = $fiyat * $katilimci;
$kdv = $toplam_fiyat - ($toplam_fiyat / 1.18);

?>

<div class="satir">
	<span>K.D.V</span>
	<b><?php echo number_format($kdv, 2, ',', '.'); ?> TL</b>
</div>
<div class="satir toplamsatiri">
	<span>Toplam</span>
	<b><?php echo number_format($toplam_fiyat, 2, ',', '.'); ?> TL</b>
</div>