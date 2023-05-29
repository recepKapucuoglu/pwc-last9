<?php require_once('_db.php'); 
	
	
	
	if ($_SESSION['dashboardUser']){
		$db->where('user_id', $_SESSION['dashboardUserId']);
		$resultsFavorite = $db->get('web_user_favorite');
		$favori_array = array();
		foreach ($resultsFavorite as $valueFavorite) {
			$favori_array[] = $valueFavorite['edu_id'];
		}
	}
	
	//Sayfa hesaplama
								
	$more = intval($_POST['more']);
	$closed = intval($_POST['closed']);
	// 10 kayıt için
	$list = $more * 15;
	$next = $more + 1;
	$prev = $more - 1;
	
	
	$sort = intval($_POST['id']);
	$egitimCheck = $_POST['egitimCheck'];
	$listType = $_POST['listType'];
	
	$egitimSayac = 0;
	$dateToday = date("Y-m-d");
	
	switch($sort) {
		case "0": $sortName="egitim_tarih"; $ascDsc="asc"; $sortNameGenel = "id";  $ascDscGenel="desc"; break;
		case "1": $sortName="ucret"; $ascDsc="asc"; $sortNameGenel = "id";  $ascDscGenel="desc"; break;
		case "2": $sortName="ucret"; $ascDsc="desc"; $sortNameGenel = "id";  $ascDscGenel="desc"; break;
		case "3": $sortName="egitim_adi"; $ascDsc="asc"; $sortNameGenel = "baslik";  $ascDscGenel="asc"; break;
		case "4": $sortName="egitim_adi"; $ascDsc="desc"; $sortNameGenel = "baslik";  $ascDscGenel="desc"; break;
		default : $sortName="egitim_tarih"; $ascDsc="asc"; $sortNameGenel = "id";  $ascDscGenel="desc"; break;
	}
	$egitim_search = valueClear($_POST['arama']);
	
	
	if($listType==2) echo "<div class=\"row\">";
	
	// Açık Eğitim Sorgusu
	$i=0;
	$db->where('egitim_tarih',$dateToday,'>=');
	$db->where('durum', 1);
	if($egitim_search<>"")
		$db->where ("(kategoriler LIKE '%".$egitim_search."%' OR egitim_adi LIKE '%".$egitim_search."%' OR etiketler LIKE '%".$egitim_search."%')");
	
	if(count($egitimVal>0)) { 
		$sqlEdu = "";
		foreach ($egitimCheck as $egitimVal) { 
			$sqlEdu.= "kategoriler LIKE '%".$egitimVal."%' OR ";
		}
		$sqlEdu = substr($sqlEdu, 0, -3);
		$db->where ("(".$sqlEdu.")");
	}
	$db->orderBy($sortName,$ascDsc);
	$resultsCalender = $db->get('education_calender_list');
	
	// Kapanacak eğitimleri buluyoruz.
	foreach ($resultsCalender as $valueCalender) { 
		$acik_egitimler[]=$valueCalender['edu_id'];
	}
	
	
	$acikEgitimResult = array_slice($resultsCalender, $list, 15);
	$kapaliEgitimGeriyeKalan = 15 - count($acikEgitimResult);
	
	
	// Kapalı Eğitim Sorgusu Geriye kalan
	$db->where('durum', 1);
	if($egitim_search<>"")
		$db->where ("(kategoriler LIKE '%".$egitim_search."%' OR baslik LIKE '%".$egitim_search."%')");
	if($acik_egitimler<>"")
		$db->where('id', $acik_egitimler, 'NOT IN');
	if(count($egitimVal>0)) { 
		$sqlEdu = "";
		foreach ($egitimCheck as $egitimVal) { 
			$sqlEdu.= "kategoriler LIKE '%".$egitimVal."%' OR ";
		}
		$sqlEdu = substr($sqlEdu, 0, -3);
		$db->where ("(".$sqlEdu.")");
	}
	$db->orderBy($sortNameGenel,$ascDscGenel);
	$resultsEducation = $db->get('education_list');
	
	
	$kapaliEgitimResult = array_slice($resultsEducation, $closed, $kapaliEgitimGeriyeKalan);
								
	$toplamEgitimSayisi = count($resultsCalender) + count($resultsEducation);
	
	$toplamKayit = ceil($toplamEgitimSayisi / 15);
								
	
	
	
	foreach ($acikEgitimResult as $valueCalender) { 
		$egitimSayac++;
		$i++;
		if($listType==2) echo "<div class=\"col-xs-12 col-sm-6 col-md-4 col-lg-4\">";
?>
<div class="egitimkutu-tip2 egitimkutu-tip-liste">
	<figure>
		<?php if ($_SESSION['dashboardUser']){ if (in_array($valueCalender['edu_id'], $favori_array)) $aktifEdu = "aktif"; else $aktifEdu = ""; ?><div id="<?php echo $valueCalender['edu_id']; ?>" class="favori <?php echo $aktifEdu; ?> hint--left hint--rounded" aria-label="Favorilere Ekle!"></div><?php } ?>
		<a href="<?php echo $valueCalender['seo_url']; ?>"><img src="<?php echo $site_url.$valueCalender['resim']; ?>" alt="<?php echo $valueCalender['resim_alt_etiket']; ?>" /></a>
	</figure>
	<div class="basliklar">
		<div class="favoriiptal">Favorilerimden Çıkar!</div>
		<a href="<?php echo $valueCalender['seo_url']; ?>">
			<h4><?php echo $valueCalender['egitim_adi']; ?></h4>
			<p><?php echo $valueCalender['kisa_aciklama']; ?></p>
			<div class="bilgiler">
				<time><?php echo date2Human($valueCalender['egitim_tarih']); ?></time> <?php if($listType==2) echo "<br/>"; ?>
			
				<lokasyon <?php if($listType==2) echo "style='margin-bottom:-25px; position:relative; margin-left:-180px;'"; else echo "style='margin-left:120px'"; ?>><?php if($valueCalender['webex']==1) echo "Webex"; else echo $valueCalender['sehir_adi']; ?></lokasyon>
				<div class="fiyat">
					<!--<del>1.673,99 TL</del>-->
					<b <?php if($listType==2) echo "style='font-size:14px; '";?> ><?php if($valueCalender['webex']==1) echo "Ücretsiz"; else echo number_format($valueCalender['ucret'], 2, ',', '.')." TL + KDV"; ?></b>
				</div>
			</div>
		</a>
	</div>
</div>
<?php if($listType==2) echo "</div>"; $modClear=$egitimSayac%3; if($modClear==0) echo "<div class=\"clearfix\"></div>"; } ?>

<!-- Açık tarihi bulunmayan eğitimler -->
<?php 	
	
	$closedEdu = 0;
									
	foreach ($kapaliEgitimResult as $valueCalender) { 
		$egitimSayac++;
		$i++;
		$closedEdu++;
		if($listType==2) echo "<div class=\"col-xs-12 col-sm-6 col-md-4 col-lg-4\">";
?>
<div class="egitimkutu-tip2 egitimkutu-tip-liste">
	<figure>
		<?php if ($_SESSION['dashboardUser']){ if (in_array($valueCalender['id'], $favori_array)) $aktifEdu = "aktif"; else $aktifEdu = ""; ?><div id="<?php echo $valueCalender['id']; ?>" class="favori <?php echo $aktifEdu; ?> hint--left hint--rounded" aria-label="Favorilere Ekle!"></div><?php } ?>
		<a href="<?php echo $valueCalender['seo_url']; ?>"><img src="<?php echo $site_url.$valueCalender['resim']; ?>" alt="<?php echo $valueCalender['resim_alt_etiket']; ?>" /></a>
	</figure>
	<div class="basliklar">
		<div class="favoriiptal">Favorilerimden Çıkar!</div>
		<a href="<?php echo $valueCalender['seo_url']; ?>">
			<h4><?php echo $valueCalender['baslik']; ?></h4>
			<p><?php echo $valueCalender['kisa_aciklama']; ?></p>
			<div class="bilgiler">
				<time>Bu eğitim için açık bir tarih bulunmamaktadır. <br/>* Bilgi al formunu doldurarak ilgili eğitim takvimi planlandığında sizinle iletişime geçmemizi sağlayabilirsiniz.</time>
			</div>
		</a>
	</div>
</div>
<?php if($listType==2) echo "</div>"; $modClear=$egitimSayac%3; if($modClear==0) echo "<div class=\"clearfix\"></div>"; } if($egitimSayac==0) 
		echo "<div class=\"alert alert-danger\">
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
			<strong>Bilgilendirme!</strong> Aradığınız kritere uygun eğitim bulunmamaktadır.
		</div>"; 
		if($listType==2) echo "</div>";
?>
<br/>
							
<?php 
//Sayfalama

if($toplamEgitimSayisi>$i) {
	echo "<div style='position: absolute; width: 100%;'>";
	if($prev<0) 
		$disabledStle = " opacity: 0.5; cursor: default; pointer-events: none;";
	else
		$disabledStle = "";
	
	echo "<div id=\"dahafazla\" onclick=\"return education_more(".$prev.",".$closedEdu.");\" class=\"dahafazla\" style=\"float:left; width:132px;".$disabledStle."\">GERİ</div>"; 
	echo "<div style=\"float: left; padding-top: 13px; padding-left: 20px; text-align: center;\">Sayfa No:<br/>".$next." / ".$toplamKayit."</div>";
	if($toplamKayit<=$next)
		$disabledStle = " opacity: 0.5; cursor: default; pointer-events: none;";
	else
		$disabledStle = "";
	echo "<div id=\"dahafazla\" onclick=\"return education_more(".$next.",".$closedEdu.");\" class=\"dahafazla\" style=\"float:left; width:132px; margin-left:20px;".$disabledStle."\">İLERİ</div>
	</div>";
}

?>
