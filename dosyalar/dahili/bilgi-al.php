<?php include('../dosyalar/dahili/header.php');


$page_url = $_SERVER['REQUEST_URI'];
$page_url = explode("/",$page_url);
$page_url = end($page_url);
$page_url = t_decode($page_url);
$db->where('seo_url', $page_url);
$results = $db->get('education_list');
foreach ($results as $value) {
	$id=$value['id'];
	$resim=$value['resim'];
	$aciklama=t_decode($value['aciklama']);
	$kisa_aciklama=t_decode($value['kisa_aciklama']);
	$resim_alt_etiket=$value['resim_alt_etiket'];
	$egitim_suresi=$value['egitim_suresi'];
	$egitim_adi=$value['baslik'];
	$seo_url=$value['seo_url'];
	$kimler_katilmali=t_decode($value['kimler_katilmali']);
	$neden_katilmali=t_decode($value['neden_katilmali']);

	
}
?>
	<section id="sayfaust" style="background-image:url(dosyalar/images/sayfaust-bg.jpg);">
		<div class="basliklar">
			<div class="baslik">EĞİTİMLERİMİZ</div>
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
					<a itemprop="item" href="#"><span itemprop="name">Bilgi Formu</span></a>
					<meta itemprop="position" content="4" />
				</li>
			</ol>
		</div>
	</section>
	<section class="ortakisim">
		<div class="container">
			<table class="tablesepet sepetlist sepetozeti">
				<tbody>
					<tr>
						<td>
							<div class="urunkutusu">
								<div class="resim"><img src="<?php echo $site_url.$resim; ?>" alt="<?php echo $resim_alt_etiket; ?>" /></div>
								<div class="adi"><?php echo $egitim_adi; ?> <br /><small>Eğitim Süresi: <?php echo $egitim_suresi; ?></small></div>
							</div>
						</td>
						<td><?php echo $kisa_aciklama; ?></td>
						
					</tr>
				</tbody>
			</table>
			<form action="#" class="form form-color">
				<div class="baslik">
					<b>Bilgi Formu</b><span>Kişisel Bilgiler</span>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<div class="label-div">
							<input type="text" name="adsoyad" onkeyup="this.setAttribute('value', this.value);" value=""/>
							<label for="adsoyad">Ad Soyad*</label>
						</div>
						<div class="label-div">
							<input type="tel" name="telefon" onkeyup="this.setAttribute('value', this.value);" value=""/>
							<label for="telefon">Telefon</label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<div class="label-div">
							<input type="email" name="email" onkeyup="this.setAttribute('value', this.value);" value=""/>
							<label for="email">E-Posta*</label>
						</div>
						<div class="label-div">
							<input type="text" name="sirketadi" onkeyup="this.setAttribute('value', this.value);" value=""/>
							<label for="sirketadi">Şirket Adı</label>
						</div>
					</div>
				</div>
				<div class="baslik">
					<span>Size Nasıl Yardımcı Olabiliriz?</span>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<div class="label-div">
							<span>
								<input class="magic-checkbox" type="checkbox" id="check1" name="check1"/>
								<label for="check1">Bu eğitim için kontenjan açıldığında haberdar olmak istiyorum.</label>
							</span>
						</div>
						<div class="label-div">
							<span>
								<input class="magic-checkbox" type="checkbox" id="check2" name="check2"/>
								<label for="check2">Bu eğitimi çalıştığım şirket için özel olarak düzenlemek istiyorum.</label>
							</span>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<div class="label-div">
							<span>
								<input class="magic-checkbox" type="checkbox" id="check3" name="check3"/>
								<label for="check3">Bu eğitim için katılıma açık bir tarih belirlendiğinde haberdar olmak istiyorum.</label>
							</span>
						</div>
						<div class="label-div">
							<span>
								<input class="magic-checkbox" type="checkbox" id="check4" name="check4"/>
								<label for="check4">PwC Business School duyurularından haberdar olmak istiyorum.</label>
							</span>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="label-div">
							<textarea name="diger" id="diger" cols="30" rows="10" onkeyup="this.setAttribute('value', this.value);" value=""></textarea>
							<label for="diger">Diğer</label>
						</div>
					</div>
				</div>
				<input type="submit" class="buton renk2" value="Gönder"/>
			</form>
		</div>
	</section>
<?php include('../dosyalar/dahili/footer.php');?>