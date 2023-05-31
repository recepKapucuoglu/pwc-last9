<?php
include('dosyalar/dahili/header.php');

$page_url = $_SERVER['REQUEST_URI'];
$page_url = explode("/",$page_url);
$page_url_total = count($page_url);

//Kategori URL'sini buluyoruz.
$page_categories_url = $page_url_total - 2;
$kategori_seo_url = $page_url[$page_categories_url];
$page_url = end($page_url);
$page_url = t_decode($page_url);
$db->where('seo_url', $page_url);
$results = $db->get('education_calender_list');
foreach ($results as $value) {
	$id=$value['id'];
	$edu_id=$value['edu_id'];
	$resim=$value['resim'];
	$aciklama=t_decode($value['edu_aciklama']);
	$resim_alt_etiket=$value['resim_alt_etiket'];
	$konum=$value['konum'];
	$adres=$value['adres'];
	$sehir=$value['sehir_adi'];
	$egitim_suresi=$value['egitim_suresi'];
	$egitim_tarih=$value['egitim_tarih'];
	$baslangic_saat=$value['baslangic_saat'];
	$bitis_saat=$value['bitis_saat'];
	$ucret=$value['ucret'];
	$egitim_adi=$value['egitim_adi'];
	$etiketler=$value['etiketler'];
	$webex=$value['webex'];
	$webex_url=$value['webex_url'];
	$durum=$value['durum'];
	$seo_url=$value['seo_url'];
	$education_seo_url=$value['education_seo_url'];
	$types=$value['types'];
	// $kimler_katilmali=t_decode($value['kimler_katilmali']);
	// $neden_katilmali=t_decode($value['neden_katilmali']);
	//geçici edit***************** üstteki 2 veriyi education_listten alacagız.
	$db->where('id',$edu_id);
	$result=$db->getOne('education');
	$kimler_katilmali=t_decode($result['kimler_katilmali']);
	$neden_katilmali=t_decode($result['neden_katilmali']);
	$not=t_decode($result['not']);
	//********* */
	$etiketlerExplode = explode(",", $etiketler);

}

// get education info
$db->where('id', $edu_id);
$education = $db->getOne('education');
$video = $education['video'];
if($video <> "")
{
	$links = explode("?v=", $video);
	$video = $links[1];
}

$tarih_suan = date("Y-m-d");


$db->where('seo_url', $kategori_seo_url);
$resultsCategories = $db->get('categories');
foreach ($resultsCategories as $valueCategories) {
	$kategoriBaslik=$valueCategories['baslik'];
}

if ($_SESSION['dashboardUser']){
	$db->where('user_id', $_SESSION['dashboardUserId']);
	$resultsFavorite = $db->get('web_user_favorite');
	$favori_array = array();
	foreach ($resultsFavorite as $valueFavorite) {
		$favori_array[] = $valueFavorite['edu_id'];
	}
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
					<a itemprop="item" href="egitimlerimiz"><span itemprop="name">Eğitimlerimiz</span></a>
					<meta itemprop="position" content="2" />
				</li>
				<?php
					if($kategoriBaslik<>""){
				?>
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="<?php echo $kategori_seo_url; ?>"><span itemprop="name"><?php echo $kategoriBaslik; ?></span></a>
					<meta itemprop="position" content="2" />
				</li>
				<?php } ?>
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="javascript:;"><span itemprop="name"><?php echo $egitim_adi; ?></span></a>
					<meta itemprop="position" content="3" />
				</li>
			</ol>
		</div>
	</section>
	<section class="ortakisim">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
					<div class="egitimdetay">
						<article>
							<header>
								<h1><?php echo $egitim_adi; ?></h1>
								<div class="etkilesim">
									
									<?php
									if ($_SESSION['dashboardUser']){ if (in_array($edu_id, $favori_array)) $aktifEdu = "aktif"; else $aktifEdu = ""; ?>
									<div class="favori <?php echo $aktifEdu; ?>" id="<?php echo $edu_id; ?>">Favorilere Ekle</div>
									<?php } ?>
									<div class="paylas" id="deneme">
										<ul>
											<li>
												<span><i class="fas fa-share-alt"></i> Paylaş</span>
												<ul>
													<li><a href="https://www.facebook.com/sharer/sharer.php?u=https://www.okul.pwc.com.tr/<?php echo $_SERVER["REQUEST_URI"]; ?>&quote=" title="Share on Facebook" target="_blank" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(document.URL) + '&quote=' + encodeURIComponent(document.URL)); return false;"><i class="fab fa-facebook-f"></i> Facebook</a></li>
													<li><a href="https://twitter.com/intent/tweet?source=https://www.okul.pwc.com.tr/<?php echo $_SERVER["REQUEST_URI"]; ?>&text=https://www.okul.pwc.com.tr/<?php echo $_SERVER["REQUEST_URI"]; ?>" target="_blank" title="Tweet" onclick="window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent(document.title) + ':%20'  + encodeURIComponent(document.URL)); return false;"><i class="fab fa-twitter"></i> Twitter</a></li>
													<li><a href="http://www.linkedin.com/shareArticle?mini=true&url=https://www.okul.pwc.com.tr/<?php echo $_SERVER["REQUEST_URI"]; ?>&title=<?php echo $baslik; ?>&summary=&source=https://www.okul.pwc.com.tr/<?php echo $_SERVER["REQUEST_URI"]; ?>" target="_blank" title="Share on LinkedIn" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url=' + encodeURIComponent(document.URL) + '&title=' +  encodeURIComponent(document.title)); return false;"><i class="fab fa-linkedin-in"></i> LinkedIn</a></li>
												</ul>
											</li>
										</ul>
									</div>
								</div>
							</header>
							<figure style="margin-top:60px">
								<div id="prom">
									<?php
									if($video <> ""){
									?>
									<div class="embed-responsive embed-responsive-16by9">
										<iframe class="embed-responsive-item" src="https://www.youtube-nocookie.com/embed/<?php echo $video; ?>?rel=0" title="<?php echo $resim_alt_etiket; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
									</div>
									<?php } else { ?>
										<div class="tarih"><b><?php echo substr($egitim_tarih,-2); ?></b><?php echo ayacevir(substr($egitim_tarih,5,2)); ?></div>
										<img src="<?php echo $site_url.$resim; ?>" alt="<?php echo $resim_alt_etiket; ?>" />
									<?php }
									?>
								</div>
								<div id="player" style="display: none;"></div>
							</figure>
							<?php if($types <>  "E-Learning") {?>
							<div class="kalansure">
								<div class="baslik">
									<span>KALAN</span>
									<b>SÜRE</b>
								</div>
								<div class="sureler countdown" data-enddate="<?php echo countDownDate($egitim_tarih)." ".$baslangic_saat; ?>"></div>
							</div>  <?php } ?>
							<section>
								<div class="schema-faq">
									<div class="schema-faq-section aktif">
										<strong class="schema-faq-question"><i class="fas fa-graduation-cap"></i> Eğitim İçeriği</strong>
										<div class="schema-faq-answer" style="">
											<?php echo $aciklama; ?>
										</div>
									</div>
									<?php if($kimler_katilmali<>"") { ?>
									<div class="schema-faq-section aktif">
										<strong class="schema-faq-question"><i class="fas fa-users"></i> Kimler Katılmalı?</strong>
										<div class="schema-faq-answer" style="">
											<?php echo $kimler_katilmali; ?>
										</div>
									</div>
									<?php } ?>
									<?php if($neden_katilmali<>"") { ?>
									<div class="schema-faq-section aktif">
										<strong class="schema-faq-question"><i class="fas fa-user-plus"></i> Neden Katılmalı?</strong>
										<div class="schema-faq-answer" style="">
											<?php echo $neden_katilmali; ?>
										</div>
									</div>
									<?php } ?>
									<?php if($not<>"") { ?>
									<div class="schema-faq-section aktif">
										<strong class="schema-faq-question"><i class="fas fa-user-plus"></i> Not</strong>
										<div class="schema-faq-answer" style="">
											<?php echo $not; ?>
										</div>
									</div>
									<?php } ?>
								</div>
							</section>
						</article>
					</div>
				</div>
				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
					<aside>
						<div class="bilesen-detay">
							<div class="bilesenic">
								<?php if($webex==1){ ?>

								<div class="fiyatlandirma">
									<div class="fiyat">
										<span>Katılım</span>
										<b>Ücretsiz</b>
									</div>
									<div class="satinal buton button13"><a href="<?php echo $webex_url; ?>" target="_blank"><i class="user-icon"></i><span>Katıl</span></a></div>
								</div>


								<?php } else { ?>
								<div class="fiyatlandirma">
									<div class="fiyat">
										<span>Ücret</span>
										<b><?php echo number_format($ucret, 2, ',', '.'); ?> <span> TL + KDV (%18)</span></b>
									</div>
									<!--<div class="fiyat ozel">
										<span>PWC Müşterilerine Özel</span>
										<b>1.673,99 TL</b>
									</div>-->
									<div class="satinal button13"><a href="uyelik/<?php echo $seo_url; ?>"><i class="user-icon"></i><span>Kayıt Ol</span></a></div>
									<div class="bilgial button13"><a href="bilgi-formu/<?php echo $seo_url; ?>"><i class="info-icon"></i><span>Bilgi Al</span></a></div>
								</div>
								<?php } ?>
							</div>
						</div>
						<?php if($webex<>1){ ?>
						<p style="font-size:14px; line-height:16px; text-align:left; font-weight:bold"><a href="iptal_ve_indirim_politikasi.php" target="_blank">İptal ve İndirim Politikamızı incelemek için tıklayınız.</a></p>
						<?php } ?>
						<div class="bilesen-detay">
							<div class="baslik">Eğitim Detayları</div>
							<div class="bilesenic">
								<ul class="egitimtakvim">
								<?php if($types <> "E-Learning"){ ?>
									<li><i class="icon tarih-icon"></i> Tarih: <?php echo date2Human($egitim_tarih); ?></li>
									<?php } ?>
									<?php if($webex<>1){ ?>
									<li><i class="icon saat-2-icon"></i> Eğitim Süresi: <?php echo $egitim_suresi; ?></li>
									<?php } ?>
									<?php if($types <> "E-Learning"){ ?>
									<li><i class="icon saat-1-icon"></i> Başlangıç Saati: <?php echo substr($baslangic_saat,0,5); ?></li>
									<?php } if($bitis_saat<>"" AND $bitis_saat<>"00:00:00"){ ?><li><i class="icon saat-2-icon"></i> Bitiş Saati: <?php echo substr($bitis_saat,0,5); ?></li><?php } ?>
									<?php if($webex==1){ ?>
										<li><i class="icon yer-icon"></i> Webex</li>
									<?php } else { 
										if($types != 'E-Learning')
										{?>
									<?php if($sehir<>""){ ?><li><i class="icon yer-icon"></i> Eğitim Yeri: <?php echo $sehir; ?></li><?php } } ?>
									<?php if($adres<>""){ ?><li><i class="icon yer-icon"></i> Adres: <?php echo $adres; ?></li><?php } ?>
									<?php } ?>
								</ul>
								<?php if($konum<>""){ ?>
								<div class="harita">
									<div id="map_harita" class="map" style="height:300px;"></div>
									<script>
									function requiredValues(map_id,map_lat,map_lng,map_zoom) {
										var map = new google.maps.Map(document.getElementById(map_id), {
										  center: {lat: map_lat, lng: map_lng},
										  zoom: map_zoom,
										  zoomControl: false,
										  fullscreenControl: false,
										  mapTypeControl: false,
										  streetViewControl: false,
										  styles: [
											{elementType: 'geometry', stylers: [{color: '#575757'}]},
											{elementType: 'labels.text.stroke', stylers: [{color: '#575757'}]},
											{elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
											{
											  featureType: 'administrative.locality',
											  elementType: 'labels.text.fill',
											  stylers: [{color: '#d59563'}]
											},
											{
											  featureType: 'poi',
											  stylers: [{visibility: "off"}]
											},
											{
											  featureType: 'poi.park',
											  elementType: 'geometry',
											  stylers: [{visibility: "off"}]
											},
											{
											  featureType: 'poi.park',
											  elementType: 'labels.text.fill',
											  stylers: [{visibility: "off"}]
											},
											{
											  featureType: 'road',
											  elementType: 'geometry',
											  stylers: [{color: '#2d2d2d'}]
											},
											{
											  featureType: 'road',
											  elementType: 'geometry.stroke',
											  stylers: [{color: '#212a37'}]
											},
											{
											  featureType: 'road',
											  elementType: 'labels.text.fill',
											  stylers: [{color: '#ffffff'}]
											},
											{
											  featureType: 'road.highway',
											  elementType: 'geometry',
											  stylers: [{color: '#f1c93d'}]
											},
											{
											  featureType: 'road.highway',
											  elementType: 'geometry.stroke',
											  stylers: [{color: '#1f2835'}]
											},
											{
											  featureType: 'road.highway',
											  elementType: 'labels.text.fill',
											  stylers: [{color: '#ffffff'}]
											},
											{
											  featureType: 'road.local',
											  elementType: 'geometry',
											  stylers: [{color: '#febc3d'}]
											},
											{
											  featureType: 'road.local',
											  elementType: 'geometry.stroke',
											  stylers: [{color: '#1f2835'}]
											},
											{
											  featureType: 'road.local',
											  elementType: 'labels.text.fill',
											  stylers: [{color: '#ffffff'}]
											},
											{
											  featureType: 'transit',
											  elementType: 'geometry',
											  stylers: [{color: '#575757'}]
											},
											{
											  featureType: 'transit.station',
											  elementType: 'labels.text.fill',
											  stylers: [{color: '#d59563'}]
											},
											{
											  featureType: 'water',
											  elementType: 'geometry',
											  stylers: [{color: '#17263c'}]
											},
											{
											  featureType: 'water',
											  elementType: 'labels.text.fill',
											  stylers: [{color: '#515c6d'}]
											},
											{
											  featureType: 'water',
											  elementType: 'labels.text.stroke',
											  stylers: [{color: '#17263c'}]
											}
										  ]
										});
										var image = 'dosyalar/images/mapicon.png';
										var beachMarker = new google.maps.Marker({
										  position: {lat: map_lat, lng: map_lng},
										  map: map,
										  icon: image
										});
									}
									function initMap() {
										requiredValues('map_harita',<?php echo $konum; ?>,16);
									}
									</script>
									<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAN-iCGnFtB4aTufXJvx3Bp6IxMfaWEN6U&callback=initMap" async defer></script>
								</div>
								<?php } ?>
							</div>
						</div>
						<?php
							$db->where('edu_cal_id',  $id);
							$totalEgitmen = $db->getValue ("education_instructor", "count(id)");
							if($totalEgitmen>0) {
						?>
						<div class="bilesen" style="background:#ffb600">
							<div class="baslik" style="color:#2d2d2d">Eğitmenler</div>
							<div class="bilesenic">
								<div class="egitmenler">
									<?php
									$db->where('edu_cal_id', $id);
									$results = $db->get('education_instructor_list');
									foreach ($results as $valueIns) {
									?>
									<div class="egitmen">
										<a href="javascript:;">
											<figure style="width: 80px !important;">
												<img src="<?php echo $site_url.$valueIns['resim']; ?>" alt="<?php echo $valueIns['resim_alt_etiket']; ?>" />
											</figure>
											<b><?php echo $valueIns['adsoyad']; ?></b>
											<p style="margin-bottom: 0px !important;"><?php echo $valueIns['aciklama']; ?></p>
                                            <?php if(isset($valueIns['linkedin'])) { ?><i class="fab fa-linkedin-in linkedinbutton" onclick="window.open('<?php echo $valueIns['linkedin']; ?>', '_blank');"></i><?php }; ?>
										</a>
									</div>
									<?php } ?>

								</div>
							</div>
						</div>
						<?php } ?>
						<?php if($etiketler<>"") { ?>
						<div class="bilesen" style="background:#ffb600">
							<div class="baslik"style="color:#2d2d2d">Etiketler</div>
							<div class="bilesenic">
								<div class="etiketler">
									<?php foreach ($etiketlerExplode as $etiket) {
										echo "<a href=\"egitimlerimiz.php?s=".$etiket."\">".$etiket."</a>";
									} ?>
								</div>
							</div>
						</div>
						<?php } ?>
					</aside>
				</div>
			</div>
		</div>
	</section>
	<?php if($webex<>1){ ?>
	<a id="sepetdynamic" href="uyelik/<?php echo $seo_url; ?>" class="kayitol-buton"><span>Kayıt Ol</span></a>
	<?php } ?>
	<?php include('dosyalar/dahili/onecikanegitimler_detay.php');?>
	<?php include('dosyalar/dahili/ebulten.php');?>
<?php include('dosyalar/dahili/footer.php');?>
<script>

$(window).scroll(function() {
    var height = $(window).scrollTop();
    if (height > 200) {
        $('#sepetdynamic').css({'display': 'block'});
    } else {
        $('#sepetdynamic').css({'display': 'none'});
    }
});
</script>