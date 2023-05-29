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
	$genel_toplam = $ucret * 1.18;
	$kdv = $ucret - ($ucret / 1.18);
}

if($edu_cal_id==""){
	header("Location: https://www.okul.pwc.com.tr");
	exit;
}
?>
<?php
if($_POST){
	// Katılımcı Bilgileri
	$adsoyad[] = valueClear($_POST['katilimci_adsoyad']);
	$telefon[] = valueClear($_POST['katilimci_telefon']);
	$firma_telefon[] = valueClear($_POST['katilimci_firma_telefon']);
	$email[] = valueClear($_POST['katilimci_email']);
	$firma[] = valueClear($_POST['katilimci_firma']);
	$unvan[] = valueClear($_POST['katilimci_unvan']);
	$not = valueClear($_POST['katilimci_notu']);
	$edu_cal_id = intval($_POST['edu_cal_id']);
	$user_id = intval($_POST['user_id']);

	$adet = intval($_POST['adet']);

	$_SESSION['katilimcilar'] = $_POST;
} else if($_SESSION['katilimcilar']){
	$adet = intval($_SESSION['katilimcilar']['adet']);
}
$adet = 1;

$db->where("id",$edu_cal_id);
$results = $db->get('education_calender');
foreach ($results as $value) {
	$fiyat = $value['ucret'];
}

$toplam_fiyat = ($fiyat * $adet) * 1.18;


$kdv = $toplam_fiyat - ($toplam_fiyat / 1.18);

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
					<a itemprop="item" href="javascript:;"><span itemprop="name">Ödeme</span></a>
					<meta itemprop="position" content="4" />
				</li>
			</ol>
		</div>
	</section>
	<section class="ortakisim">
		<div class="formMessage col-md-10 col-md-push-1"></div>
		<form id="contact-form" class="sepetform" method="post" action="sepet-ozet/<?php echo $seo_url; ?>">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="sepet-adimlar">
							<div class="adim ok"><a href="katilimcilar/<?php echo $seo_url; ?>"><i class="icon user-icon"></i> Katılımcı</a></div>
							<div class="adim ok"><a href="javascript:;"><i class="icon kk-icon"></i> Fatura Bilgileri</a></div>
							<div class="adim"><a href="javascript:;"><i class="icon ozet-icon"></i> Kayıt Özeti</a></div>
							<div class="adim"><a href="javascript:;"><i class="icon ss-icon"></i> Kaydınız Tamamlandı</a></div>
						</div>
						<div class="sepet-div">
							<div class="row">
								<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
									<h3><b>Fatura Bilgileri</b></h3>
									
									<p>Lütfen fatura bilgilerinizi giriniz.</p>
									<table class="tablesepet sepetlist sepetozeti">
										<tbody>
											<tr>
												<td>
													<div class="urunkutusu">
														<div class="resim"><img src="<?php echo $site_url.$resim; ?>" alt="<?php echo $resim_alt_etiket; ?>" /></div>
														<div class="adi"><?php echo $egitim_adi; ?> <br /><small>Eğitim Tarihi: <?php echo date2human($egitim_tarih); ?></small></div>
													</div>
												</td>
												<td style="display: none;"><?php echo $_SESSION['katilimcilar']['adet']; ?> Katılımcı</td>
												<td>
													<div class="fiyat">
														
														<b><?php echo number_format($ucret, 2, ',', '.'); ?> TL</b>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
									<h4><b>Ödeme Yöntemi</b></h4>
									<br />
									<div class="radiotablar">
										<div class="radiotab aktif">
											<div class="baslik">
												<span class="radiobox-div">
													<input class="magic-radio" type="radio" id="efthavale" name="odemeyontemi" class="odemeyontemi" checked="checked"/>
													<label for="efthavale">EFT / Havale</label>
												</span>
											</div>
											<div class="icerik" style="display:block;">
												<p style="color:#2d2d2d">Eğitim bedeli ekibimiz tarafından eğitim tarihinden 1 gün önce tarafınıza iletiliyor olacaktır. İndirim hakkı olan müşterilerimize indirim oranı uygulanmış tutar yansıtılıyor olacak. Ödemelerinizi tarafımızdan gönderilecek maile istinaden yapmanız rica olunur.</p>
												
											</div>
										</div>
										
									</div>
									<table class="tablesepet katilimcibilgileri">
										<thead>
											<th>Fatura Detayları</th>
										</thead>
										<tbody>
											<tr>
												<td>
													<div class="row">
														<span class="radiobox-div">
															<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
																<?php $bireysel=""; $kurumsal=""; if($_SESSION['fatura_bilgileri']['fatura-turu']==1) { $bireysel ="checked"; $bireyselStyle=""; $kurumsalStyle="display:none"; } else{  $bireyselStyle="display:none"; $kurumsalStyle=""; $kurumsal = "checked"; } ?>
																<input class="magic-radio" type="radio" name="fatura-turu"  id="bireyselCheck" <?php echo $bireysel; ?> value="1"  class="odemeyontemi" />
																<label for="bireyselCheck" style="width: 110px;float: left;">Bireysel</label>
																<input class="magic-radio" type="radio"  name="fatura-turu" class="odemeyontemi" value="2" <?php echo $kurumsal; ?> id="kurumsalCheck"  />
																<label for="kurumsalCheck" style="width: 110px;float: left;">Kurumsal</label>
																<br/><br/>
															</div>
														</span>	
													</div>
													
													<div id="bireysel" style="<?php echo $bireyselStyle; ?>">
											<div class="row">
												<div class="col-md-6">
													<div class="label-div3">
														<label>Fatura Ad Soyad *</label>
														<input type="text" name="fatura_adsoyad" id="fatura_adsoyad"  value="<?php echo $_SESSION['fatura_bilgileri']['fatura_adsoyad']; ?>"/>
													</div>
												
												</div>
												<div class="col-md-6">
													<div class="label-div3">
														<label>T.C Kimlik No. *</label>
														<input oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $_SESSION['fatura_bilgileri']['tc_no']; ?>" maxlength="11" name="tc_no" id="tc_no" type="text"/>
													</div>
													
												</div>
											</div>
										</div>
										<div id="kurumsal" style="<?php echo $kurumsalStyle; ?>">	
											<div class="row">
													<div class="col-md-6">
														<div class="label-div3">
															<label>Firma Unvanı *</label>
															<input type="text" name="firma_unvani" id="firma_unvani"  value="<?php echo $_SESSION['fatura_bilgileri']['firma_unvani']; ?>"/>
														</div>
														
													</div>
													<div class="col-md-3">
														<div class="label-div3">
															<label>Vergi Dairesi *</label>
															<input type="text"  name="vergi_dairesi" id="vergi_dairesi" value="<?php echo $_SESSION['fatura_bilgileri']['vergi_dairesi']; ?>" />
														</div>
														
													</div>
													<div class="col-md-3">
														<div class="label-div3">
															<label>Vergi Numarası *</label>
															<input type="text"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="10" value="<?php echo $_SESSION['fatura_bilgileri']['vergi_no']; ?>" name="vergi_no" id="vergi_no" type="text" />
														</div>
														
													</div>
											</div>
										</div>
										<div class="row">
												<div class="col-md-6">
													<div class="label-div3">
														<label>Fatura E-mail *</label>
														<input type="text" name="fatura_email" id="fatura_email"  value="<?php if($_SESSION['fatura_bilgileri']) echo $_SESSION['fatura_bilgileri']['fatura_email']; else  echo $email[0][0]; ?>"/>
													</div>
												
												</div>
												<div class="col-md-6">
													<div class="label-div3">
														<label>Telefon *</label>
														<input name="fatura_telefon" id="fatura_telefon" type="tel"  value="<?php if($_SESSION['fatura_bilgileri']) echo $_SESSION['fatura_bilgileri']['fatura_telefon']; else echo $firma_telefon[0][0]; ?>"/>
													</div>
													
												</div>
											</div>
										<div class="row">
											<div class="col-md-12">
												<div class="label-div3">
													<label>Adres *</label>
													<input type="text" id="adres" name="adres" type="text" value="<?php echo $_SESSION['fatura_bilgileri']['adres']; ?>" />
												</div>
											</div>
											
										</div>
													
													
													
												</td>
											</tr>
										</tbody>
									</table>
									
								</div>
								<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
									<aside>
										<div class="bilesen">
											<div class="baslik" style="color:#2d2d2d;">Toplam Ücret</div>
											<div class="bilesenic">
												<div class="sepettoplam">
													<div class="satir">
														<span>Birim Fiyat</span>
														<b><?php echo number_format($ucret, 2, ',', '.'); ?> TL</b>
													</div>
													<div class="satir">
														<span>Kişi Sayısı</span>
														<b><?php echo $adet; ?></b>
													</div>
													<div class="satir">
														<span>K.D.V</span>
														<b><?php echo number_format($kdv, 2, ',', '.'); ?> TL</b>
													</div>
													<div class="satir toplamsatiri">
														<span>G. Toplam</span>
														<b><?php echo number_format($toplam_fiyat, 2, ',', '.'); ?> TL</b>
													</div>
													<div class="satir">
														<span style="font-size: 11px; margin-top: .5rem; color: #e0301e; font-weight: 900;">İndirim oranına göre değişiklik gösterebilir.</span>
													</div>
												</div>
												
											</div>
										</div>
										<p style="font-size:14px; line-height:16px; text-align:left; font-weight:bold"><a href="iptal_ve_indirim_politikasi.php" target="_blank">İptal ve İndirim Politikamızı incelemek için tıklayınız.</a></p>
										
										
										<div class="satinal buton renk1 button13"><a  href="javascript:;" onclick="return odeme_gonder();" ><i class="odemeyap"></i><span>Devam Et</span></a></div>
										
										
									</aside>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
<?php include('dosyalar/dahili/footer.php');?>