<?php include('dosyalar/dahili/header.php');


$page_url = $_SERVER['REQUEST_URI'];
$page_url = explode("/",$page_url);
$page_url = end($page_url);
$page_url = t_decode($page_url);
$db->where('seo_url', $page_url);
$results = $db->get('url_list');
foreach ($results as $value) {
	$source=$value['source'];
}

$diger_text = "Detay";
	$form_title = "EĞİTİM BİLGİ FORMU";
if($source=="education-calender"){

	$db->where('seo_url', $page_url);
	$results = $db->get('education_calender_list');
	foreach ($results as $value) {
		$edu_cal_id=$value['id'];
		$edu_id=$value['edu_id'];
		$resim=$value['resim'];
		$resim_alt_etiket=$value['resim_alt_etiket'];
		$sehir=$value['sehir_adi'];
		$egitim_suresi=$value['egitim_suresi'];
		$egitim_tarih=$value['egitim_tarih'];
		$ucret=$value['ucret'];
		$egitim_adi=$value['egitim_adi'];
		$seo_url=$value['seo_url'];
	}
	
} elseif($source=="education") {
	
	$db->where('seo_url', $page_url);
	$results = $db->get('education_list');
	foreach ($results as $value) {
		$edu_id=$value['id'];
		$resim=$value['resim'];
		$resim_alt_etiket=$value['resim_alt_etiket'];
		$sehir="";
		$egitim_suresi=$value['egitim_suresi'];
		$egitim_tarih="";
		$ucret="";
		$egitim_adi=$value['baslik'];
		$seo_url=$value['seo_url'];
	}
} else {
	$egitim_adi = "Şirketlere Özel Eğitim Bilgi Formu";
	$seo_url = "#";
	$diger_text = "Talebinizin Detayı";
	$form_title = "ŞİRKETLERE ÖZEL EĞİTİM BİLGİ FORMU";
}
?>
	<section id="sayfaust" style="background-image:url(<?php echo $site_url; ?>dosyalar/images/sayfaust-bg.jpg);">
		<div class="basliklar">
			<div class="baslik"><?php echo $form_title; ?></div>
			<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="/"><span itemprop="name">Anasayfa</span></a>
					<meta itemprop="position" content="1" />
				</li>
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="/egitimlerimiz"><span itemprop="name">Eğitimlerimiz</span></a>
					<meta itemprop="position" content="2" />
				</li>
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="<?php echo $seo_url; ?>"><span itemprop="name"><?php echo $egitim_adi; ?></span></a>
					<meta itemprop="position" content="3" />
				</li>
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="javascript:;"><span itemprop="name">Bilgi Formu</span></a>
					<meta itemprop="position" content="4" />
				</li>
			</ol>
		</div>
	</section>
	<section class="ortakisim">
		<div class="container" id="bilgiFormu">
			<?php if($source=="education-calender" OR $source=="education"){ ?>
			<table class="tablesepet sepetlist sepetozeti">
				<tbody>
					<tr>
						<td>
							<div class="urunkutusu">
								<div class="resim"><img src="<?php echo $site_url.$resim; ?>" alt="<?php echo $resim_alt_etiket; ?>" /></div>
								<div class="adi"><b><?php echo $egitim_adi; ?></b> <br /><small>Eğitim Süresi: <?php echo $egitim_suresi; ?></small></div>
							</div>
						</td>
						<td>
							<?php if($egitim_tarih<>""){ ?><b>Eğitim Tarihi :</b> <?php echo date2Human($egitim_tarih); } ?><br/>
							<?php if($sehir<>""){ ?> <b>Şehir:</b> <?php echo $sehir; } ?>
						</td>
						<td>
							<?php if($ucret<>""){ ?>
							<div class="fiyat">
								<b><?php echo number_format($ucret, 2, ',', '.'); ?> TL</b>
							</div>
							<?php } ?>
						</td>
					</tr>
				</tbody>
			</table>
			<?php } ?>
			<div class="bilgiFormList">
			</div>
			<form id="bilgi_form" method="post" class="form form-color" onsubmit="return bilgi_form_gonder();">
				<input type="hidden" name="edu_cal_id" value="<?php echo $edu_cal_id; ?>"/>
				<input type="hidden" name="edu_id" id="edu_id" value="<?php echo $edu_id; ?>"/>
				<div class="baslik">
					<b>Bilgi Formu</b><span>Kişisel Bilgiler</span>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<div class="label-div">
							<input type="text" name="adsoyad" id="adsoyad" value=""/>
							<label for="adsoyad">Ad Soyad*</label>
						</div>
						<div class="label-div">
							<input type="tel" name="telefon" id="telefon" value=""/>
							<label for="telefon">Telefon</label>
						</div>
						<?php if($source<>"education-calender" AND $source<>"education"){ ?>
						<div class="label-div">
							<input type="text" name="kisi_sayisi" id="kisi_sayisi" value=""/>
							<label for="telefon">Eğitimin Düzenleneceği Kişi Sayısı*</label>
						</div>
						<?php } ?>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<div class="label-div">
							<input type="email" name="email" id="email" value=""/>
							<label for="email">E-Posta*</label>
						</div>
						<div class="label-div">
							<input type="text" name="sirketadi" id="sirketadi" value=""/>
							<label for="sirketadi">Şirket Adı*</label>
						</div>
						<?php if($source<>"education-calender" AND $source<>"education"){ ?>
						<div class="label-div">
							<input type="text" name="lokasyon" id="lokasyon" value=""/>
							<label for="telefon">Eğitimin Düzenleneceği Lokasyon*</label>
						</div>
						<?php } ?>
					</div>
					<?php if($source<>"education-calender" AND $source<>"education"){ ?>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="label-div">
							<input type="text" name="egitim_konu" id="egitim_konu" value=""/>
							<label for="telefon">Eğitimin Verilecek Konu*</label>
						</div>
					</div>
					<?php } ?>
					
				</div>
				<div class="baslik">
					<span>Size Nasıl Yardımcı Olabiliriz?</span>
				</div>
				<div class="row">
					<?php if($source=="education-calender" OR $source=="education"){ ?>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<div class="label-div">
							<span>
								<input class="magic-checkbox" type="checkbox" id="check1" value="1" name="kontenjan"/>
								<label for="check1">Bu eğitim için kontenjan açıldığında haberdar olmak istiyorum.</label>
							</span>
						</div>
						<div class="label-div">
							<span>
								<input class="magic-checkbox" type="checkbox" id="check2" value="1" name="ozel"/>
								<label for="check2">Bu eğitimi çalıştığım şirket için özel olarak düzenlemek istiyorum.</label>
							</span>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<div class="label-div">
							<span>
								<input class="magic-checkbox" type="checkbox" id="check3" value="1" name="katilim"/>
								<label for="check3">Bu eğitim için katılıma açık bir tarih belirlendiğinde haberdar olmak istiyorum.</label>
							</span>
						</div>
						<div class="label-div">
							<span>
								<input class="magic-checkbox" type="checkbox" id="check4" value="1" name="duyuru"/>
								<label for="check4">PwC Business School duyurularından haberdar olmak istiyorum.</label>
							</span>
						</div>
					</div>
					<?php } ?>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="label-div">
							<textarea name="diger" id="diger" cols="30" rows="10" value=""></textarea>
							<label for="diger"><?php echo $diger_text; ?></label>
						</div>
					</div>
				</div>
				<center><div class="bilgial buton renk2 button13"><a href="javascript:;" onclick="return bilgi_form_gonder();"><i class="info-icon"></i><span>Gönder</span></a></div></center>
			</form>
		</div>
	</section>
<?php include('dosyalar/dahili/footer.php');?>