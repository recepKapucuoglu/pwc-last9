<?php include('dosyalar/dahili/header.php');
$_SESSION['katilimcilar']['adet'] = 1;
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
	$kdv = $genel_toplam - $ucret;
}

if($edu_cal_id==""){
	header("Location: https://www.okul.pwc.com.tr");
	exit;
}
?>
<?php
$db->where('email', $_SESSION['dashboardUser']);
$results = $db->get('web_user');
foreach ($results as $value) {
	$fullName = $value['fullname'];
	$title = $value['title'];
	$company = $value['company'];
	$email = $value['email'];
	$phone = $value['phone'];
	$user_id = $value['id'];
}
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
					<a itemprop="item" href="javascript:;"><span itemprop="name">Kayıt Formu</span></a>
					<meta itemprop="position" content="4" />
				</li>
			</ol>
		</div>
	</section>
	<section class="ortakisim">
		<div class="formMessage col-md-10 col-md-push-1"></div>
						
		<form id="contact-form" class="sepetform" method="post" action="sepet-sonuc/">
			<input type="hidden" name="edu_cal_id" id="edu_cal_id" value="<?php echo $edu_cal_id; ?>"/>
			<input name="user_id" type="hidden" id="user_id" value="<?php echo $user_id; ?>" />
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						
						<div class="sepet-div">
							<div class="row">
								<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
									<table class="tablesepet sepetlist">
										<thead>
											<th>Eğitimin Adı</th>
											<th>Katılımcı Sayısı</th>
											<th>Birim Fiyat</th>
										</thead>
										<tbody>
											<tr>
												<td>
													<div class="urunkutusu">
														<div class="resim"><img src="<?php echo $site_url.$resim; ?>" alt="<?php echo $resim_alt_etiket; ?>" /></div>
														<div class="adi"><?php echo $egitim_adi; ?></div>
													</div>
												</td>
												<td>
													<div class="adetsec">
														<span class="minus">-</span>
														<input type="text" class="adet" id="adet" name="adet" value="1" onkeyup="this.setAttribute('value', this.value);"/>
														<span class="plus">+</span>
													</div>
												</td>
												<td>
													<div class="fiyat">
														<b><?php echo number_format($ucret, 2, ',', '.'); ?> TL</b>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
									<table class="tablesepet katilimcibilgileri">
										<thead>
											<th>Katılımcı Bilgileri</th>
										</thead>
										<tbody>
											<tr>
												<td>
													<table>
														<tbody class="katilimci_satirlari">
															<tr class="katilimci_satir">
																<td style="padding:0px">
																	<table>
																		<tr style="border:0px"><td colspan="3" style="padding: 0px 20px;"><h4 style="color: #d3202e;"><b>1. Katılımcı</b></h4></td></tr>
																		<tr>
																			<td>
																				<div class="label-div3">
																					<label>Ad Soyad*</label>
																					<input type="text" name="katilimci_adsoyad[]" value="<?php echo $fullName; ?>"/> <br/>
																					<label>Firma Adı*</label>
																					<input type="text" name="katilimci_firma[]" value="<?php echo $company; ?>"/>
																				</div>
																			</td>
																			<td>
																				<div class="label-div3">
																					<label>Unvan *</label>
																					<input type="text" name="katilimci_unvan[]"  value="<?php echo $title; ?>"/><br/>
																					<label>Firma Telefon *</label>
																					<input type="tel" name="katilimci_firma_telefon[]" value=""/>
																				</div>
																			</td>
																			<td>
																				<div class="label-div3">
																					<label>Telefon*</label>
																					<input type="tel" name="katilimci_telefon[]"  value="<?php echo $phone; ?>"/><br/>
																					<label>E-Posta *</label>
																					<input type="email" name="katilimci_email[]"  value="<?php echo $email; ?>"/>
																				</div>
																			</td>
																		</tr>
																	</table>
																</td>
															</tr>
																	
															
														</tbody>
													</table>
													<table>
															<tr>
																<td style="padding: 0px 20px">
																	<div class="label-div3">
																		<label>Not</label>
																		<input type="text" name="katilimci_notu"/>
																	</div>
																</td>
															</tr>			
													</table>
												</td>
											</tr>
										</tbody>
									</table>
									
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
																<input class="magic-radio" type="radio" name="fatura-turu"  id="bireyselCheck" value="1"  class="odemeyontemi" />
																<label for="bireyselCheck" style="width: 110px;float: left;">Bireysel</label>
																<input class="magic-radio" type="radio"  name="fatura-turu" class="odemeyontemi" value="2" checked id="kurumsalCheck"  />
																<label for="kurumsalCheck" style="width: 110px;float: left;">Kurumsal</label>
																<br/><br/>
															</div>
														</span>	
													</div>
													
													<div id="bireysel" style="display:none">
											<div class="row">
												<div class="col-md-6">
													<div class="label-div3">
														<label>Fatura Ad Soyad *</label>
														<input type="text" name="fatura_adsoyad" id="fatura_adsoyad"  value="<?php echo $fullName; ?>"/>
													</div>
												
												</div>
												<div class="col-md-6">
													<div class="label-div3">
														<label>T.C Kimlik No. *</label>
														<input oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="11" name="tc_no" id="tc_no" type="text"/>
													</div>
													
												</div>
											</div>
										</div>
										<div id="kurumsal">	
											<div class="row">
													<div class="col-md-6">
														<div class="label-div3">
															<label>Firma Unvanı *</label>
															<input type="text" name="firma_unvani" id="firma_unvani"  value="<?php echo $company; ?>"/>
														</div>
														
													</div>
													<div class="col-md-3">
														<div class="label-div3">
															<label>Vergi Dairesi *</label>
															<input type="text"  name="vergi_dairesi" id="vergi_dairesi" />
														</div>
														
													</div>
													<div class="col-md-3">
														<div class="label-div3">
															<label>Vergi Numarası *</label>
															<input type="text"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="10" name="vergi_no" id="vergi_no" type="text" />
														</div>
														
													</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="label-div3">
													<label>Adres *</label>
													<input type="text" id="adres" name="adres" type="text" />
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
											<div class="baslik">Toplam Ücret</div>
											<div class="bilesenic">
												<div class="sepettoplam" id="sepettoplam">
													<div class="satir">
														<span>Tutar</span>
														<b><?php echo number_format($ucret, 2, ',', '.'); ?> TL</b>
													</div>
													<div class="satir">
														<span>K.D.V</span>
														<b><?php echo number_format($kdv, 2, ',', '.'); ?> TL</b>
													</div>
													<div class="satir toplamsatiri">
														<span>G. Toplam</span>
														<b><?php echo number_format($genel_toplam, 2, ',', '.'); ?> TL</b>
													</div>
												</div>
											</div>
										</div>
										<p style="font-size:14px; line-height:16px; text-align:left; font-weight:bold"><a href="iptal_ve_indirim_politikasi.php" target="_blank">İptal ve İndirim Politikamızı incelemek için tıklayınız.</a></p>
										
										<p style="font-size:10px; line-height:14px; text-align:left">Aşağıda yer alan "Satın Al" butonunu tıklayarak, PwC Türkiye <a href="https://www.pwc.com.tr/kisisel-verilerin-korunmasi-ve-veri-gizlilik-bildirimi" target="_blank">Kişisel Verilerin Korunması ve Veri Gizlilik Bildirimini</a> incelediğimi ve PwC Türkiye ile paylaştığım tüm kişisel verilerimin doğru, güncel ve tam olduğunu beyan ve taahhüt ediyor ve işbu formdaki kişisel verilerimin PwC Türkiye tarafından işlenmesine ve aktarılmasına rıza gösteriyorum. Fikrinizi değiştirir ve bizden bilgi almak isterseniz, <a href="https://www.pwc.com.tr/global/forms/contactUsNew.html?parentPagePath=/content/pwc/tr/tr" target="_blank">Bize Ulaşın</a> sayfamızdan e-posta yollayabilirsiniz.  </p>
										<p style="font-size:10px; line-height:14px; text-align:left">PwC Türkiye adına etkinlik esnasında çekilen/yapılan video ve fotoğraflar da dahil olmak üzere kişisel verilerimin 6698 sayılı Kişisel Verilerin Korunması Kanunu (“KVKK”) uyarınca, sadece aşağıda açıklandığı çerçevede işlenecek, kaydedilecek, saklanacak, güncellenecek ve 3. kişilerle paylaşılabilecek olduğunu kabul ediyorum. KVKK’da belirtilen haklarımı biliyorum ve kişisel verilerimin PwC Türkiye tarafından aşağıda belirtilen amaçlar dâhilinde işlenmesine ve aktarılmasına rıza gösteriyorum  </p>

										<div class="satinal buton renk1 button13"><a  href="javascript:;" onclick="return form_gonder();" ><i class="odemeyap"></i><span>Kayıt Ol</span></a></div>
									
										
										<!--<div class="label-div3">
											<input type="text" name="kupon" class="kuponinput" placeholder="Çek / Promosyon Kodu" value=""/>
										</div>-->
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